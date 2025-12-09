<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\PasswordResetMail;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan form lupa password
     */
    public function showForgotPasswordForm()
    {
        // Pastikan user logout sebelum menampilkan halaman lupa password
        Auth::logout();
        return view('forgot_password');
    }

    /**
     * Kirim email reset password
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Cek apakah email terdaftar di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::warning('Reset password attempt for unregistered email', ['email' => $request->email]);

            // Cek jika request AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email tidak terdaftar di sistem kami.',
                    'errors' => ['email' => 'Email tidak terdaftar di sistem kami.']
                ], 422);
            }

            // Kembali dengan error hanya untuk kolom email
            return back()->withErrors(['email' => 'Email tidak terdaftar di sistem kami.'])->withInput();
        }

        // Generate token
        $token = Str::random(60);

        // Simpan token ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        // Buat URL reset password
        $resetUrl = URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(60),
            ['token' => $token, 'email' => $request->email]
        );

        try {
            // Kirim email
            Mail::to($request->email)->send(new PasswordResetMail($resetUrl, $user->name));

            Log::info('Password reset link sent successfully', [
                'email' => $request->email,
                'user_id' => $user->id,
                'sent_at' => now()
            ]);

            $successMessage = 'Tautan reset kata sandi telah dikirim ke email Anda!';

            // Cek jika request AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMessage
                    // TIDAK ADA REDIRECT DI SINI - tetap di halaman lupa password
                ], 200);
            }

            return back()->with('status', $successMessage);
        } catch (\Exception $e) {
            Log::error('Failed to send password reset email', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $errorMessage = 'Gagal mengirim email. Silakan coba lagi nanti.';

            // Cek jika request AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'errors' => ['email' => $errorMessage]
                ], 500);
            }

            return back()->withErrors(['email' => $errorMessage]);
        }
    }

    /**
     * Tampilkan form reset password
     */
    public function showResetPasswordForm(Request $request, $token = null)
    {
        // Pastikan user logout sebelum menampilkan halaman reset password
        Auth::logout();

        // Validasi token
        $email = $request->email;

        if (!$email || !$token) {
            Log::warning('Invalid password reset request - missing email or token', [
                'email' => $email,
                'token' => $token
            ]);

            return redirect()->route('password.request')->withErrors(['token' => 'Token tidak valid atau telah kadaluarsa.']);
        }

        // Cek token di database
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record || !Hash::check($token, $record->token)) {
            Log::warning('Invalid password reset token', [
                'email' => $email,
                'token_exists' => !!$record,
                'token_matches' => $record ? Hash::check($token, $record->token) : false
            ]);

            return redirect()->route('password.request')->withErrors(['token' => 'Token tidak valid atau telah kadaluarsa.']);
        }

        // Cek apakah token sudah kadaluarsa (lebih dari 60 menit)
        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            Log::info('Password reset token expired and deleted', ['email' => $email]);

            return redirect()->route('password.request')->withErrors(['token' => 'Token telah kadaluarsa. Silakan request reset password baru.']);
        }

        return view('reset_password', ['token' => $token, 'email' => $email]);
    }

    /**
     * Proses reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            // Validasi token
            $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

            if (!$record) {
                Log::warning('Password reset attempt - no token record found', ['email' => $request->email]);

                // Cek jika request AJAX
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Token tidak valid atau telah kadaluarsa.',
                        'errors' => ['token' => 'Token tidak valid atau telah kadaluarsa.']
                    ], 422);
                }

                return back()->withErrors(['token' => 'Token tidak valid atau telah kadaluarsa.'])->withInput();
            }

            if (!Hash::check($request->token, $record->token)) {
                Log::warning('Password reset attempt - token mismatch', ['email' => $request->email]);

                // Cek jika request AJAX
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Token tidak valid atau telah kadaluarsa.',
                        'errors' => ['token' => 'Token tidak valid atau telah kadaluarsa.']
                    ], 422);
                }

                return back()->withErrors(['token' => 'Token tidak valid atau telah kadaluarsa.'])->withInput();
            }

            // Cek apakah token sudah kadaluarsa
            if (now()->diffInMinutes($record->created_at) > 60) {
                DB::table('password_reset_tokens')->where('email', $request->email)->delete();

                Log::info('Password reset token expired during reset attempt', ['email' => $request->email]);

                // Cek jika request AJAX
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Token telah kadaluarsa. Silakan request reset password baru.',
                        'errors' => ['token' => 'Token telah kadaluarsa. Silakan request reset password baru.']
                    ], 422);
                }

                return back()->withErrors(['token' => 'Token telah kadaluarsa. Silakan request reset password baru.'])->withInput();
            }

            // Update password user
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                Log::warning('Password reset attempt - user not found', ['email' => $request->email]);

                // Cek jika request AJAX
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email tidak ditemukan.',
                        'errors' => ['email' => 'Email tidak ditemukan.']
                    ], 422);
                }

                return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
            }

            // Update password
            $user->password = Hash::make($request->password);

            // Jika user menggunakan Google Login sebelumnya, hapus google_id agar bisa login dengan password
            if ($user->google_id) {
                $user->google_id = null;
                Log::info('Removed Google ID for user during password reset', ['user_id' => $user->id]);
            }

            $user->save();

            // Hapus token dari database
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            Log::info('Password reset successful', [
                'user_id' => $user->id,
                'email' => $user->email,
                'reset_at' => now()
            ]);

            $successMessage = 'Password berhasil direset! Silakan login dengan password baru Anda.';

            // Cek jika request AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMessage,
                    'redirect' => route('login') // Redirect ke login page setelah reset berhasil
                ], 200);
            }

            return redirect()->route('login')->with('success', $successMessage);
        } catch (\Exception $e) {
            // Log error detail untuk debugging
            Log::error('Password reset failed with exception', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => [
                    'has_token' => !empty($request->token),
                    'email' => $request->email
                ]
            ]);

            $errorMessage = 'Terjadi kesalahan sistem. Silakan coba lagi nanti.';

            // Cek jika request AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'errors' => ['general' => $errorMessage]
                ], 500);
            }

            return back()->withErrors(['general' => $errorMessage])->withInput();
        }
    }
}
