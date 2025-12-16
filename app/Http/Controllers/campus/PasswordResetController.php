<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\Campus;
use App\Mail\CampusPasswordResetMail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Menampilkan form lupa password untuk kampus
     */
    public function showForgotPasswordForm()
    {
        // PERUBAHAN: Hapus semua session terkait reset password
        session()->forget(['status', 'email']);

        return view('campus.campus_forgot_password');
    }

    /**
     * Mengirim link reset password ke email kampus
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Debugging: Log request
        Log::info('Campus forgot password request received', ['email' => $request->email]);

        // Validasi input
        $request->validate([
            'email' => 'required|email'
        ]);

        // Cek apakah email terdaftar di tabel campuses
        $campus = Campus::where('email', $request->email)->first();

        if (!$campus) {
            Log::warning('Campus email not found in database', ['email' => $request->email]);

            // Return JSON response untuk AJAX
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email tidak terdaftar di sistem kami.'
                ], 404);
            }

            return back()->withErrors(['email' => 'Email tidak terdaftar di database kampus/sekolah.'])
                ->withInput();
        }

        try {
            // Generate token reset password
            $token = Str::random(60);

            // Hash token untuk disimpan di database
            $hashedToken = Hash::make($token);

            // PERUBAHAN: Selalu update atau insert token baru, tidak perlu cek token lama
            // Ini memungkinkan user untuk request reset password berkali-kali
            DB::table('campus_password_resets')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => $hashedToken,
                    'created_at' => now()
                ]
            );

            // Debugging: Log token generation
            Log::info('Password reset token generated for campus', [
                'email' => $request->email,
                'token' => $token,
                'action' => 'New token generated (allowing multiple requests)'
            ]);

            // Buat URL reset password
            $resetUrl = url('/reset-password-kampus/' . $token . '?email=' . urlencode($request->email));

            // Kirim email reset password
            Mail::to($request->email)->send(new CampusPasswordResetMail($resetUrl, $campus));

            // Debugging: Log email sending
            Log::info('Password reset email sent to campus', [
                'email' => $request->email,
                'reset_url' => $resetUrl
            ]);

            // Return JSON response untuk AJAX
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Email reset kata sandi telah dikirim. Silakan periksa email Anda.',
                    'email' => $request->email
                ]);
            }

            // PERUBAHAN: Redirect ke halaman yang sama tanpa session
            // Gunakan flash session sekali pakai
            return redirect()->route('campus.forgot.password')
                ->with('status', 'Email reset kata sandi telah dikirim. Silakan periksa email Anda.');
        } catch (\Exception $e) {
            // Debugging: Log error
            Log::error('Error sending campus password reset email', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return JSON response untuk AJAX
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengirim email. Silakan coba lagi.'
                ], 500);
            }

            return back()->withErrors(['email' => 'Terjadi kesalahan saat mengirim email. Silakan coba lagi.'])
                ->withInput();
        }
    }

    /**
     * Menampilkan form reset password
     */
    public function showResetPasswordForm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;

        // PERUBAHAN: Hapus session success jika ada
        session()->forget('success');

        // Validasi token
        $resetRecord = DB::table('campus_password_resets')->where('email', $email)->first();

        if (!$resetRecord || !Hash::check($token, $resetRecord->token)) {
            Log::warning('Invalid or expired password reset token for campus', [
                'email' => $email,
                'token_provided' => $token,
                'has_record' => $resetRecord ? 'Yes' : 'No'
            ]);
            return redirect()->route('campus.forgot.password')
                ->withErrors(['token' => 'Token reset password tidak valid atau telah kadaluarsa.']);
        }

        // Cek apakah token sudah kadaluarsa (24 jam)
        $createdAt = Carbon::parse($resetRecord->created_at);
        if ($createdAt->diffInHours(now()) > 24) {
            // Hapus token yang kadaluarsa
            DB::table('campus_password_resets')->where('email', $email)->delete();

            Log::warning('Expired password reset token for campus', [
                'email' => $email,
                'created_at' => $createdAt,
                'hours_diff' => $createdAt->diffInHours(now())
            ]);

            return redirect()->route('campus.forgot.password')
                ->withErrors(['token' => 'Token reset password telah kadaluarsa. Silakan request reset password lagi.']);
        }

        return view('campus.campus_reset_password', [
            'token' => $token,
            'email' => $email
        ]);
    }

    /**
     * Memproses reset password
     */
    public function resetPassword(Request $request)
    {
        // Debugging: Log reset attempt
        Log::info('Campus password reset attempt', [
            'email' => $request->email,
            'has_token' => !empty($request->token)
        ]);

        // Validasi input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Validasi token
        $resetRecord = DB::table('campus_password_resets')->where('email', $request->email)->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            Log::warning('Invalid token during campus password reset', [
                'email' => $request->email,
                'token_provided' => $request->token,
                'has_record' => $resetRecord ? 'Yes' : 'No'
            ]);

            // Return JSON response untuk AJAX
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token reset password tidak valid.'
                ], 400);
            }

            return back()->withErrors(['token' => 'Token reset password tidak valid.'])
                ->withInput();
        }

        // Cek apakah token sudah kadaluarsa (24 jam)
        $createdAt = Carbon::parse($resetRecord->created_at);
        if ($createdAt->diffInHours(now()) > 24) {
            DB::table('campus_password_resets')->where('email', $request->email)->delete();

            Log::warning('Expired token during campus password reset', [
                'email' => $request->email,
                'created_at' => $createdAt
            ]);

            // Return JSON response untuk AJAX
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token reset password telah kadaluarsa. Silakan request reset password lagi.'
                ], 400);
            }

            return back()->withErrors(['token' => 'Token reset password telah kadaluarsa. Silakan request reset password lagi.'])
                ->withInput();
        }

        try {
            // Update password kampus
            $campus = Campus::where('email', $request->email)->firstOrFail();
            $campus->password = Hash::make($request->password);
            $campus->save();

            // Hapus token reset setelah berhasil
            DB::table('campus_password_resets')->where('email', $request->email)->delete();

            // Debugging: Log successful reset
            Log::info('Campus password successfully reset', [
                'email' => $request->email,
                'campus_name' => $campus->nama_kampus
            ]);

            // Return JSON response untuk AJAX
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kata sandi telah berhasil direset. Silakan gunakan kata sandi baru untuk masuk.',
                    'redirect' => null
                ]);
            }

            // PERUBAHAN: Redirect tanpa pesan sukses
            return redirect()->route('campus.login');
        } catch (\Exception $e) {
            // Debugging: Log error
            Log::error('Error resetting campus password', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return JSON response untuk AJAX
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mereset password. Silakan coba lagi.'
                ], 500);
            }

            return back()->withErrors(['email' => 'Terjadi kesalahan saat mereset password. Silakan coba lagi.'])
                ->withInput();
        }
    }

    public function resetAllTokensForEmail(Request $request)
    {
        $email = $request->email;

        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Email diperlukan'
            ], 400);
        }

        $deleted = DB::table('campus_password_resets')
            ->where('email', $email)
            ->delete();

        Log::info('All password reset tokens deleted for email', [
            'email' => $email,
            'deleted_count' => $deleted
        ]);

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus $deleted token untuk email $email"
        ]);
    }
}
