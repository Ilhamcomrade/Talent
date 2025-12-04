<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Notifications\CampusRegistrationSuccess;

class RegisterController extends Controller
{
    // Step 1 - Data Diri
    public function showStep1()
    {
        return view('campus.campus_register');
    }

    public function processStep1(Request $request)
    {
        // Debug: Log request data
        Log::info('Campus Registration Step 1 - Request Data:', $request->all());

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'jabatan' => 'required|string',
            'email' => 'required|email|unique:campuses,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'no_hp.required' => 'Nomor HP harus diisi',
            'jabatan.required' => 'Jabatan harus dipilih',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        if ($validator->fails()) {
            Log::error('Campus Registration Step 1 - Validation Failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data step 1 ke session
        $request->session()->put('campus_register.step1', $request->all());

        Log::info('Campus Registration Step 1 - Success, redirecting to step 2');

        return redirect()->route('campus.register.process')
            ->with('success', 'Data diri berhasil disimpan! Silakan lanjutkan ke langkah berikutnya.');
    }

    // Step 2 - Data Kampus
    public function showStep2(Request $request)
    {
        if (!$request->session()->has('campus_register.step1')) {
            Log::warning('Campus Registration - Accessing step 2 without step 1 data');
            return redirect()->route('campus.register')
                ->with('error', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        return view('campus.campus_register_process');
    }

    public function processStep2(Request $request)
    {
        Log::info('Campus Registration Step 2 - Request Data:', $request->all());

        $validator = Validator::make($request->all(), [
            'nama_kampus' => 'required|string|max:255',
            'jumlah_pegawai' => 'required|string',
            'jenis_institusi' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_kampus.required' => 'Nama kampus harus diisi',
            'jumlah_pegawai.required' => 'Jumlah pegawai harus dipilih',
            'jenis_institusi.required' => 'Jenis institusi harus dipilih',
            'logo.required' => 'Logo kampus harus diunggah',
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'logo.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Log::error('Campus Registration Step 2 - Validation Failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Upload logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('campus_logos', 'public');
            $request->session()->put('campus_register.logo_path', $logoPath);
            Log::info('Campus Registration Step 2 - Logo uploaded:', ['path' => $logoPath]);
        }

        // Simpan data step 2 ke session
        $step2Data = [
            'nama_kampus' => $request->nama_kampus,
            'jumlah_pegawai' => $request->jumlah_pegawai,
            'jenis_institusi' => $request->jenis_institusi,
        ];

        $request->session()->put('campus_register.step2', $step2Data);

        Log::info('Campus Registration Step 2 - Success, redirecting to step 3');
        Log::info('Campus Registration Step 2 - Session data saved:', $step2Data);

        return redirect()->route('campus.register.location')
            ->with('success', 'Data kampus berhasil disimpan! Silakan lanjutkan ke langkah berikutnya.');
    }

    // Step 3 - Lokasi Kampus
    public function showStep3(Request $request)
    {
        if (!$request->session()->has('campus_register.step1')) {
            Log::warning('Campus Registration - Accessing step 3 without step 1 data');
            return redirect()->route('campus.register')
                ->with('error', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        if (!$request->session()->has('campus_register.step2')) {
            Log::warning('Campus Registration - Accessing step 3 without step 2 data');
            return redirect()->route('campus.register.process')
                ->with('error', 'Silakan lengkapi data kampus terlebih dahulu.');
        }

        return view('campus.campus_register_location');
    }

    public function processStep3(Request $request)
    {
        Log::info('Campus Registration Step 3 - Request Data:', $request->all());

        $validator = Validator::make($request->all(), [
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa_kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string|max:255',
        ], [
            'provinsi.required' => 'Provinsi harus dipilih',
            'kota.required' => 'Kota harus dipilih',
            'kecamatan.required' => 'Kecamatan harus dipilih',
            'desa_kelurahan.required' => 'Desa/Kelurahan harus dipilih',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi',
            'alamat_lengkap.max' => 'Alamat lengkap maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            Log::error('Campus Registration Step 3 - Validation Failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data step 3 ke session
        $request->session()->put('campus_register.step3', $request->all());

        // Proses final registration
        return $this->completeRegistration($request);
    }

    private function completeRegistration(Request $request)
    {
        try {
            $step1 = $request->session()->get('campus_register.step1');
            $step2 = $request->session()->get('campus_register.step2');
            $step3 = $request->session()->get('campus_register.step3');
            $logoPath = $request->session()->get('campus_register.logo_path');

            Log::info('Campus Registration - Completing registration with data:', [
                'step1' => $step1,
                'step2' => $step2,
                'step3' => $step3,
                'logo_path' => $logoPath
            ]);

            // Validasi final data sebelum create
            if (!$step1 || !$step2 || !$step3) {
                throw new \Exception('Data registrasi tidak lengkap');
            }

            // Create campus record
            $campus = Campus::create([
                'nama_lengkap' => $step1['nama_lengkap'],
                'no_hp' => $step1['no_hp'],
                'jabatan' => $step1['jabatan'],
                'email' => $step1['email'],
                'password' => Hash::make($step1['password']),
                'nama_kampus' => $step2['nama_kampus'],
                'jumlah_pegawai' => $step2['jumlah_pegawai'],
                'jenis_institusi' => $step2['jenis_institusi'],
                'logo_path' => $logoPath,
                'provinsi' => $step3['provinsi'],
                'kota' => $step3['kota'],
                'kecamatan' => $step3['kecamatan'], // Data baru
                'desa_kelurahan' => $step3['desa_kelurahan'], // Data baru
                'alamat_lengkap' => $step3['alamat_lengkap'],
            ]);

            // 🌟 KIRIM EMAIL NOTIFIKASI SETELAH REGISTRASI BERHASIL
            $this->sendRegistrationEmail($campus, $step1);

            // Clear session data
            $request->session()->forget('campus_register');

            Log::info('Campus Registration - Successfully created campus:', [
                'campus_id' => $campus->id,
                'nama_kampus' => $campus->nama_kampus,
                'email' => $campus->email
            ]);

            // Login campus automatically
            auth()->guard('campus')->login($campus);

            Log::info('Campus Registration - User logged in successfully, redirecting to dashboard');

            return redirect()->route('campus.dashboard')
                ->with('success', 'Pendaftaran kampus berhasil! Email konfirmasi telah dikirim ke ' . $campus->email);

        } catch (\Exception $e) {
            Log::error('Campus Registration - Error during completion:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'session_data' => [
                    'step1' => $request->session()->get('campus_register.step1'),
                    'step2' => $request->session()->get('campus_register.step2'),
                    'step3' => $request->session()->get('campus_register.step3'),
                    'logo_path' => $request->session()->get('campus_register.logo_path')
                ]
            ]);

            return redirect()->route('campus.register')
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Kirim email notifikasi setelah registrasi berhasil
     */
    private function sendRegistrationEmail($campus, $step1Data)
    {
        try {
            $registrationDate = now()->translatedFormat('d F Y');
            $loginUrl = route('campus.login');

            Log::info('Sending campus registration email directly to: ' . $campus->email);

            // Kirim email langsung menggunakan Mail facade (lebih reliable)
            \Illuminate\Support\Facades\Mail::send('emails.campus_registration_success', [
                'userName' => $step1Data['nama_lengkap'],
                'campusName' => $campus->nama_kampus,
                'email' => $campus->email,
                'registrationDate' => $registrationDate,
                'loginUrl' => $loginUrl,
                'jenisInstitusi' => $campus->jenis_institusi, // ← tambahan penting
            ], function($message) use ($campus) {
                $message->to($campus->email)
                        ->subject('Pendaftaran Kampus/Sekolah Berhasil - InotalHub')
                        ->from('septiangeorgio@gmail.com', 'InotalHub'); // Hardcode untuk testing
            });

            Log::info('Campus Registration - Direct email sent successfully to:', [
                'email' => $campus->email,
                'campus_name' => $campus->nama_kampus
            ]);

        } catch (\Exception $e) {
            Log::error('Campus Registration - Failed to send direct email:', [
                'error' => $e->getMessage(),
                'email' => $campus->email,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function cancelRegistration(Request $request)
    {
        $request->session()->forget('campus_register');
        Log::info('Campus Registration - Registration cancelled by user');
        return redirect()->route('campus.register')
            ->with('info', 'Pendaftaran dibatalkan.');
    }
}
