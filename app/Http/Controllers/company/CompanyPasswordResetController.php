<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CompanyPasswordResetController extends Controller
{
    /**
     * Tampilkan form lupa password perusahaan
     */
    public function showForgotPasswordForm()
    {
        Log::info('Menampilkan form lupa password perusahaan');
        return view('company.company_forgot_password');
    }

    /**
     * Kirim link reset password ke email perusahaan
     * PERUBAHAN: Mendukung pengiriman berulang untuk email yang sama
     * PERUBAHAN: Validasi error hanya di bawah kolom email
     */
    public function sendResetLinkEmail(Request $request)
    {
        Log::info('Memulai proses pengiriman link reset password', ['email' => $request->email]);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            Log::warning('Validasi gagal pada pengiriman link reset', ['errors' => $validator->errors()]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->email;

        // Cek apakah email terdaftar di database perusahaan
        $company = Company::where('email', $email)->first();

        if (!$company) {
            Log::warning('Email tidak terdaftar di database perusahaan', ['email' => $email]);

            // PERUBAHAN: Validasi error hanya di bawah kolom email
            // Menambahkan error validator untuk email dengan pesan custom
            $validator->errors()->add('email', 'Email tidak terdaftar di sistem kami.');

            return redirect()->back()
                ->withErrors($validator) // Menggunakan $validator bukan array baru
                ->withInput();
        }

        // PERUBAHAN: Hapus token lama untuk email ini jika ada
        $existingToken = DB::table('company_password_reset_tokens')
            ->where('email', $email)
            ->first();

        if ($existingToken) {
            Log::info('Menghapus token lama untuk pengiriman ulang', [
                'email' => $email,
                'old_token' => $existingToken->token
            ]);
            DB::table('company_password_reset_tokens')
                ->where('email', $email)
                ->delete();
        }

        // Generate token baru
        $token = Str::random(64);
        Log::info('Token reset password baru dibuat', ['token' => $token, 'email' => $email]);

        // Simpan token ke database
        DB::table('company_password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Kirim email reset password
        $resetLink = route('company.password.reset', ['token' => $token]);
        Log::info('Membuat link reset password baru', ['link' => $resetLink]);

        try {
            Log::info('Mengirim email reset password', ['email' => $company->email]);

            Mail::send('emails.company_password_reset', [
                'resetLink' => $resetLink,
                'company' => $company
            ], function ($message) use ($company) {
                $message->to($company->email)
                    ->subject('Atur Ulang Kata Sandi InotalHub');
            });

            Log::info('Email reset password berhasil dikirim', [
                'email' => $company->email,
                'attempt_count' => $existingToken ? 'pengiriman ulang' : 'pengiriman pertama'
            ]);

            return redirect()->back()
                ->with('status', 'Link reset password telah dikirim ke email Anda.')
                ->with('email', $email); // Kirim email ke session untuk ditampilkan
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email reset password', [
                'email' => $company->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // PERUBAHAN: Hapus token yang sudah dibuat jika email gagal dikirim
            DB::table('company_password_reset_tokens')
                ->where('email', $email)
                ->where('token', $token)
                ->delete();

            // PERUBAHAN: Validasi error hanya di bawah kolom email untuk error pengiriman email
            $validator->errors()->add('email', 'Gagal mengirim email. Silakan coba lagi nanti.');

            return redirect()->back()
                ->withErrors($validator) // Menggunakan $validator bukan array baru
                ->withInput();
        }
    }

    /**
     * Tampilkan form reset password perusahaan
     */
    public function showResetPasswordForm(Request $request)
    {
        $token = $request->token;
        Log::info('Menampilkan form reset password', ['token' => $token]);

        // Validasi token
        $resetData = DB::table('company_password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$resetData) {
            Log::warning('Token reset password tidak valid', ['token' => $token]);
            return redirect()->route('company.password.request')
                ->withErrors(['token' => 'Token reset password tidak valid atau telah kadaluarsa.']);
        }

        // Cek apakah token masih valid (maksimal 60 menit)
        $createdAt = Carbon::parse($resetData->created_at);
        $minutesDiff = $createdAt->diffInMinutes(Carbon::now());

        Log::info('Validasi token', [
            'created_at' => $createdAt,
            'minutes_diff' => $minutesDiff,
            'email' => $resetData->email
        ]);

        if ($minutesDiff > 60) {
            DB::table('company_password_reset_tokens')->where('token', $token)->delete();
            Log::warning('Token reset password telah kadaluarsa', [
                'token' => $token,
                'minutes_diff' => $minutesDiff
            ]);

            return redirect()->route('company.password.request')
                ->withErrors(['token' => 'Token reset password telah kadaluarsa.']);
        }

        return view('company.company_reset_password', [
            'token' => $token,
            'email' => $resetData->email
        ]);
    }

    /**
     * Reset password perusahaan
     */
    public function resetPassword(Request $request)
    {
        Log::info('Memulai proses reset password', [
            'email' => $request->email,
            'has_token' => !empty($request->token)
        ]);

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            Log::warning('Validasi form reset password gagal', ['errors' => $validator->errors()]);

            // Return JSON untuk AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Validasi token
        $resetData = DB::table('company_password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetData) {
            Log::warning('Token reset password tidak ditemukan di database', [
                'email' => $request->email,
                'token' => $request->token
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token reset password tidak valid.'
                ], 400);
            }

            return redirect()->route('company.password.request')
                ->withErrors(['token' => 'Token reset password tidak valid.']);
        }

        // Cek apakah token masih valid
        $createdAt = Carbon::parse($resetData->created_at);
        $minutesDiff = $createdAt->diffInMinutes(Carbon::now());

        if ($minutesDiff > 60) {
            DB::table('company_password_reset_tokens')->where('token', $request->token)->delete();
            Log::warning('Token reset password telah kadaluarsa saat proses reset', [
                'email' => $request->email,
                'token' => $request->token,
                'minutes_diff' => $minutesDiff
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token reset password telah kadaluarsa.'
                ], 400);
            }

            return redirect()->route('company.password.request')
                ->withErrors(['token' => 'Token reset password telah kadaluarsa.']);
        }

        // Update password perusahaan
        $company = Company::where('email', $request->email)->first();

        if (!$company) {
            Log::warning('Perusahaan tidak ditemukan saat reset password', ['email' => $request->email]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email tidak terdaftar.'
                ], 400);
            }

            return redirect()->route('company.password.request')
                ->withErrors(['email' => 'Email tidak terdaftar.']);
        }

        try {
            // Update password
            $company->password = Hash::make($request->password);
            $company->save();

            Log::info('Password perusahaan berhasil direset', [
                'company_id' => $company->id,
                'email' => $company->email
            ]);

            // Hapus token setelah digunakan
            DB::table('company_password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            Log::info('Token reset password dihapus setelah digunakan', ['email' => $request->email]);

            // Return JSON untuk AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kata sandi berhasil direset.'
                ]);
            }

            // Untuk non-AJAX request, tetap redirect dengan session success
            return redirect()->route('company.login')
                ->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
        } catch (\Exception $e) {
            Log::error('Gagal mereset password perusahaan', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem. Silakan coba lagi nanti.'
                ], 500);
            }

            return redirect()->back()
                ->withErrors(['password' => 'Terjadi kesalahan sistem. Silakan coba lagi nanti.'])
                ->withInput();
        }
    }
}
