<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;

// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\JobListingController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\CalendarController; // <-- CONTROLLER BARU UNTUK KALENDER
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CampusController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\NotifController;
use App\Http\Controllers\Admin\MagangController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\ReferenceController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\DesaController;

use App\Http\Controllers\intersipController;
use App\Http\Controllers\User\UserApplicationsController;

// Company Controllers
use App\Http\Controllers\Company\RegisterController;
use App\Http\Controllers\Company\LoginController;
use App\Http\Controllers\Company\cAuthController;
use App\Http\Controllers\Company\cJobController;
use App\Http\Controllers\Company\cProfileController;
use App\Http\Controllers\Company\cNotificationController;
use App\Http\Controllers\Company\cMagangController;
use App\Http\Controllers\Company\cDashboardController;
use App\Http\Controllers\Company\CompanyController as PublicCompanyController;
use App\Http\Controllers\Company\cApplicantController;
use App\Http\Controllers\Company\CompanyJobController;
use App\Http\Controllers\Company\CompanyPasswordResetController;
use App\Http\Controllers\Company\BenefitController;

// Campus Controllers
use App\Http\Controllers\Campus\RegisterController as CampusRegisterController;
use App\Http\Controllers\Campus\LoginController as CampusLoginController;
use App\Http\Controllers\Campus\CampusController as PublicCampusController;
use App\Http\Controllers\Campus\PasswordResetController as CampusPasswordResetController;

// API Controllers
use App\Http\Controllers\Api\LocationApiController;

// Public Controllers
use App\Http\Controllers\JobController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\UserNotifController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('home'))->name('home');
Route::get('/daftar', fn() => view('daftar'))->name('register');
Route::get('/masuk', fn() => view('login'))->name('login');
Route::get('/kampus/perusahaan', fn() => view('kampus_perusahaan'))->name('kampus_perusahaan');
Route::get('/minat-pekerjaan', fn() => view('job_interest'))->name('job.interest');

Route::get('/magang', [IntersipController::class, 'index'])->name('magang.index');
Route::get('/magang/{id}', [IntersipController::class, 'show'])->name('magang.show');

// START: PERUBAHAN DI BAGIAN KONTAK (Sekarang hanya menggunakan 2 rute di satu URI)
// KEDUA ROUTE INI SUDAH BENAR DAN MENGARAH KE ContactController
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
// END: PERUBAHAN DI BAGIAN KONTAK

Route::get('/tentang-kami', fn() => view('about_us'))->name('about');
Route::get('/explore-organisasi', fn() => view('explore_organization'));
// Pencarian explore
Route::get('/explore/search', function () {
    return view('explore_organization');
})->name('explore.search');

// Group untuk route perusahaan
Route::prefix('company')->group(function () {
    // Halaman utama perusahaan
    Route::get('/', fn() => view('company.company'))->name('company');

    // Auth routes
    Route::get('/login', [App\Http\Controllers\Company\LoginController::class, 'showLoginForm'])->name('company.login');
    Route::post('/login', [App\Http\Controllers\Company\LoginController::class, 'login'])->name('company.login.submit');
    Route::post('/logout', [App\Http\Controllers\Company\LoginController::class, 'logout'])->name('company.logout');

    // ✅ ROUTE ALIAS UNTUK COMPATIBILITY DENGAN CONTROLLER
    Route::get('/lupa-password', [CompanyPasswordResetController::class, 'showForgotPasswordForm'])
        ->name('company.forgot.password');

    Route::post('/lupa-password', [CompanyPasswordResetController::class, 'sendResetLinkEmail'])
        ->name('company.password.email');

    // ✅ ROUTE RESET PASSWORD PERUSAHAAN
    Route::get('/reset-password/{token}', [CompanyPasswordResetController::class, 'showResetPasswordForm'])
        ->name('company.password.reset');

    Route::post('/reset-password', [CompanyPasswordResetController::class, 'resetPassword'])
        ->name('company.password.update');

    // Registration routes
    Route::get('/daftar', [App\Http\Controllers\Company\RegisterController::class, 'showStep1'])->name('company.register');
    Route::post('/daftar/step1', [App\Http\Controllers\Company\RegisterController::class, 'processStep1'])->name('company.register.step1');
    Route::get('/daftar/proses', [App\Http\Controllers\Company\RegisterController::class, 'showStep2'])->name('company.register.process');
    Route::post('/daftar/proses/step2', [App\Http\Controllers\Company\RegisterController::class, 'processStep2'])->name('company.register.step2');
    Route::get('/daftar/lokasi', [App\Http\Controllers\Company\RegisterController::class, 'showStep3'])->name('company.register.location');
    Route::post('/daftar/lokasi/step3', [App\Http\Controllers\Company\RegisterController::class, 'processStep3'])->name('company.register.step3');
    Route::get('/daftar/batal', [App\Http\Controllers\Company\RegisterController::class, 'cancelRegistration'])->name('company.register.cancel');

    // Semua route dalam group ini akan dilindungi middleware 'auth.company'
    Route::middleware(['auth.company'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [cDashboardController::class, 'index'])
            ->name('company.dashboard');

        Route::get('/company/jobs/{job}/applicants', [cApplicantController::class, 'showJobApplicants'])
            ->name('companiesjobs.applicants');

        // API endpoints untuk wilayah
        Route::get('/api/regencies/{provinceId}', [cJobController::class, 'getRegencies'])->name('api.regencies');
        Route::get('/api/districts/{regencyId}', [cJobController::class, 'getDistricts'])->name('api.districts');
        Route::get('/api/villages/{districtId}', [cJobController::class, 'getVillages'])->name('api.villages');
        Route::get('/api/location-details', [cJobController::class, 'getLocationDetails'])->name('api.location-details');
        Route::get('/api/job-stats', [cJobController::class, 'getStats'])->name('api.job-stats');
        
        // API untuk wilayah (alternatif jika perlu akses terproteksi)
        Route::get('/api/regencies/{id}', [cJobController::class, 'getRegencies']);
        Route::get('/api/districts/{id}', [cJobController::class, 'getDistricts']);
        Route::get('/api/villages/{id}', [cJobController::class, 'getVillages']);

        // Profil
        Route::get('/profile', [cProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [cProfileController::class, 'index'])->name('profile');
        Route::get('/company/profile', [\App\Http\Controllers\Company\cProfileController::class, 'index'])
            ->name('company.profile');

        Route::post('/company/profile/update', [\App\Http\Controllers\Company\cProfileController::class, 'update'])
            ->name('company.profile.update');
        Route::put('/company/profile/update', [cProfileController::class, 'update'])
            ->name('company.profile.update');

        // Profile Delete
        Route::delete('/company/profile/destroy', [\App\Http\Controllers\Company\cProfileController::class, 'destroy'])
            ->name('company.profile.destroy');

        // CRUD Magang
        Route::get('magang', [CMagangController::class, 'index'])->name('company.magang.index');
        Route::get('magang/create', [CMagangController::class, 'create'])->name('company.magang.create');
        Route::post('magang', [CMagangController::class, 'store'])->name('company.magang.store');
        Route::get('magang/{id}', [CMagangController::class, 'show'])->name('company.magang.show');
        Route::get('magang/{id}/edit', [CMagangController::class, 'edit'])->name('company.magang.edit');
        Route::put('magang/{id}', [CMagangController::class, 'update'])->name('company.magang.update');
        Route::delete('magang/{id}', [CMagangController::class, 'destroy'])->name('company.magang.destroy');

        // CRUD Benefit
        Route::get('benefits', [BenefitController::class, 'index'])->name('company.benefits.index');
        Route::get('benefits/create', [BenefitController::class, 'create'])->name('company.benefits.create');
        Route::post('benefits', [BenefitController::class, 'store'])->name('company.benefits.store');
        Route::get('benefits/{benefit}/edit', [BenefitController::class, 'edit'])->name('company.benefits.edit');
        Route::put('benefits/{benefit}', [BenefitController::class, 'update'])->name('company.benefits.update');
        Route::delete('benefits/{benefit}', [BenefitController::class, 'destroy'])->name('company.benefits.destroy');
        Route::patch('benefits/{benefit}/toggle-status', [BenefitController::class, 'toggleStatus'])->name('company.benefits.toggle-status');

        // Route jobs
        Route::get('jobs', [cJobController::class, 'index'])->name('companiesjobs.index');
        Route::get('jobs/create', [cJobController::class, 'create'])->name('companiesjobs.create');
        Route::post('jobs', [cJobController::class, 'store'])->name('companiesjobs.store');
        Route::get('jobs/{id}/edit', [cJobController::class, 'edit'])->name('companiesjobs.edit');
        Route::put('jobs/{id}', [cJobController::class, 'update'])->name('companiesjobs.update');
        Route::delete('jobs/{id}', [cJobController::class, 'destroy'])->name('companiesjobs.destroy');
        
        // Halaman daftar pelamar
        Route::get('jobs/pelamar', function () {
            return view('company.jobs.pelamar');
        })->name('companiesjobs.pelamar');

        // Daftar semua pelamar untuk semua job
        Route::get('/applications', [cApplicantController::class, 'index'])
            ->name('company.applications.index');

        // Pelamar per job
        Route::get('/applications/job/{id}', [cApplicantController::class, 'pelamarByJob'])
            ->name('company.applications.byJob');

        // Detail pelamar
        Route::get('/applications/show/{id}', [cApplicantController::class, 'show'])
            ->name('company.applications.show');

        // Update status
        Route::post('/applications/status/{id}', [cApplicantController::class, 'updateStatus'])
            ->name('company.applications.updateStatus');

        Route::put('applications/status/{id}', [cApplicantController::class, 'updateStatus'])
            ->name('company.applications.updateStatus');

        // Download CV
        Route::get('/applications/cv/{id}', [cApplicantController::class, 'cv'])
            ->name('company.applications.cv');

        Route::get('jobs/{id}', [cJobController::class, 'show'])->name('companiesjobs.show');
    });
});

// ===========================================================================
// ✅ ROUTE PUBLIC COMPANY DENGAN SLUG - HARUS SETELAH ROUTE STATIC
// ===========================================================================
Route::get('/company/{company:slug}', [PublicCompanyController::class, 'show'])->name('company.detail');
Route::get('/company/{company:slug}/culture', [PublicCompanyController::class, 'culture'])->name('company.culture');
Route::get('/company/{company:slug}/job', [CompanyJobController::class, 'index'])->name('company.job');
Route::get('/company/{company:slug}/salary', [PublicCompanyController::class, 'salary'])->name('company.salary');

// Routes untuk kampus
Route::get('/campus/{campus:slug}', [PublicCampusController::class, 'show'])->name('campus.detail');
Route::get('/campus/{campus:slug}/culture', [PublicCampusController::class, 'culture'])->name('campus.culture');
Route::get('/campus/{campus:slug}/prodi', [PublicCampusController::class, 'prodi'])->name('campus.prodi');
Route::get('/campus/{campus:slug}/facility', [PublicCampusController::class, 'facility'])->name('campus.facility');

Route::get('/open-intership', fn() => view('open_intership'));
Route::get('/registrasi-perusahaan', fn() => view('daftar_perusahaan'));
Route::get('/registrasi-kampus', fn() => view('daftar_kampus'));
Route::get('/sumber-daya-karir', fn() => view('career_resources'));

Route::get('/sumber-daya-karir/jelajahi-karier', function () {
    return view('career_explore');
})->name('career.explore');

Route::get('/sumber-daya-karir/pencarian-lowongan-kerja', function () {
    return view('job_search_page');
})->name('job.search.page');

Route::get('/sumber-daya-karir/kehidupan-kerja', function () {
    return view('job_life');
})->name('job.life');

Route::get('/sumber-daya-karir/jelajahi-gaji', function () {
    return view('salary_explore');
})->name('salary.explore');

// Halaman pengaturan akun dan fungsionalitasnya
Route::middleware(['auth'])->group(function () {
    // Tampilkan profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Form edit profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update profil
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/pengaturan/detail', [AccountSettingsController::class, 'index'])->name('account.settings');

    // RUTE BARU: Halaman Kontak Saya
    Route::get('/pengaturan/kontak', [AccountSettingsController::class, 'contactIndex'])->name('account.contact');

    // RUTE BARU: Halaman Akun Terhubung
    Route::get('/pengaturan/akun-terhubung', [AccountSettingsController::class, 'linkedAccountsIndex'])->name('account.linked');

    // 👇 RUTE BARU: Halaman Preferensi Notifikasi
    Route::get('/pengaturan/notifikasi', [AccountSettingsController::class, 'notificationIndex'])->name('account.notifications');

    // 👇 RUTE BARU: Halaman Bantuan & Dukungan (Tambahan Sesuai Permintaan)
    Route::get('/pengaturan/bantuan-dukungan', [AccountSettingsController::class, 'helpSupportIndex'])->name('account.help.support');

    // Rute POST untuk ganti kata sandi
    Route::post('/pengaturan/update-password', [AccountSettingsController::class, 'updatePassword'])->name('account.update.password');

    // Rute POST untuk perbarui email
    Route::post('/pengaturan/update-email', [AccountSettingsController::class, 'updateEmail'])->name('account.update.email');

    // RUTE BARU: Rute POST untuk perbarui WhatsApp
    Route::post('/pengaturan/update-whatsapp', [AccountSettingsController::class, 'updateWhatsapp'])->name('account.update.whatsapp');

    // 🌟 RUTE BARU: Proses Hapus Akun Permanen
    Route::post('/pengaturan/delete-account', [AccountSettingsController::class, 'deleteAccount'])->name('account.delete.process');

    // RUTE BARU: Rute POST untuk SIMULASI pemutusan koneksi akun
    // Ini hanya akan menyimpan status session 'disconnected'
    Route::post('/pengaturan/dummy-disconnect', [AccountSettingsController::class, 'dummyDisconnect'])->name('account.dummy.disconnect'); // 👈 Rute Baru
});

// 🌟 API NOTIFIKASI VERSI USER
Route::middleware(['auth'])->group(function () {
    // Halaman notifikasi user
    Route::get('/notifications/my', [UserNotifController::class, 'myNotifications'])->name('notifications.my');
    Route::get('/notifications/api', [UserNotifController::class, 'getMyNotificationsApi'])->name('notifications.api');
    Route::put('/notifications/api/read/{id}', [UserNotifController::class, 'markAsReadApi'])->name('notifications.api.read');
    
    // 🌟 Tambahkan ini
    Route::post('/notifications/mark-all-read', [UserNotifController::class, 'markAllRead'])
        ->name('notifications.markAllRead');
    
    // Tandai notifikasi sebagai sudah dibaca (untuk satu notifikasi)
    Route::post('/notifications/read/{id}', [UserNotifController::class, 'markAsRead'])
        ->name('notifications.markRead');
    
    // ❌ RUTE DELETE SATU NOTIFIKASI (DELETE /notifications/{id})
    Route::delete('/notifications/delete/{id}', [UserNotifController::class, 'delete'])->name('notifications.delete');

    // ❌ RUTE DELETE SEMUA NOTIFIKASI (DELETE /notifications/delete-all)
    Route::delete('/notifications/delete-all', [UserNotifController::class, 'deleteAll'])->name('notifications.deleteAll');
    Route::get('/notifications/{id}', [UserNotifController::class, 'show'])->name('notifications.show');
    Route::get('/notifications', [UserNotifController::class, 'myNotifications'])->name('notifications.index');
    Route::patch('/notifications/{id}/mark-unread', [UserNotifController::class, 'markUnread'])->name('notifications.mark-unread');
});

// Halaman tipe pekerjaan
Route::get('/tipe-pekerjaan', fn() => view('job_type'))->name('job.type');

// Group untuk routes kampus
Route::name('campus.')->group(function () {
    // Halaman utama kampus
    Route::get('/kampus', fn() => view('campus.campus'))->name('home');

    // Authentication routes
    Route::get('/login-kampus', [App\Http\Controllers\Campus\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login-kampus', [App\Http\Controllers\Campus\LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout-kampus', [App\Http\Controllers\Campus\LoginController::class, 'logout'])->name('logout');

    // Registration routes
    Route::get('/daftar-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'showStep1'])->name('register');
    Route::post('/proses-daftar-kampus/step1', [App\Http\Controllers\Campus\RegisterController::class, 'processStep1'])->name('register.step1');
    Route::get('/proses-daftar-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'showStep2'])->name('register.process');
    Route::post('/proses-daftar-kampus/step2', [App\Http\Controllers\Campus\RegisterController::class, 'processStep2'])->name('register.step2');
    Route::get('/lokasi-daftar-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'showStep3'])->name('register.location');
    Route::post('/lokasi-daftar-kampus/step3', [App\Http\Controllers\Campus\RegisterController::class, 'processStep3'])->name('register.step3');
    Route::get('/cancel-registration-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'cancelRegistration'])->name('register.cancel');

    // Password Reset Routes
    Route::get('/lupa-password-kampus', [CampusPasswordResetController::class, 'showForgotPasswordForm'])->name('forgot.password');
    Route::post('/lupa-password-kampus', [CampusPasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password-kampus/{token}', [CampusPasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password-kampus', [CampusPasswordResetController::class, 'resetPassword'])->name('password.update');

    Route::get('/mou-kampus', fn() => view('campus.mou'));
    Route::get('/pengajuan-proposal-kampus', fn() => view('campus.proposal'));
    Route::get('/pengajuan-magang-kampus', fn() => view('campus.intership'));
    Route::get('/lowongan-pekerjaan-kampus', fn() => view('campus.job'));

    // Protected routes (harus login)
    Route::middleware('auth.campus')->group(function () {
        Route::get('/dashboard-kampus', fn() => view('campus.campus_dashboard'))->name('dashboard');
    });
});

// Halaman publik Job
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// Route untuk halaman pencarian lowongan kerja
Route::get('/lowongan-kerja', [JobController::class, 'index'])->name('jobs.index');
Route::get('/lowongan-kerja/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/lowongan-kerja/filter', [JobController::class, 'filterJobs'])->name('jobs.filter');

// Form Apply
Route::get('/jobs/{id}/apply', [JobController::class, 'applyForm'])->name('jobs.apply');
Route::post('/jobs/{id}/apply', [JobController::class, 'applyStore'])->name('jobs.apply.store');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['logout.for.password'])->group(function () {
    Route::get('/lupa-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
});

Route::post('/lupa-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// ✅ TAMBAHAN RUTE GOOGLE LOGIN
Route::get('auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| PANEL ADMIN (Prefix & Name Grouping)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // 1. Dashboard, Lowongan, Pelamar, Perusahaan, Kandidat
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // 🔔 Route Notifikasi
    // Form kirim notifikasi (admin -> user)
    Route::get('/notif', [NotifController::class, 'index'])->name('notif.index');
    Route::post('/notif/send', [NotifController::class, 'send'])->name('notif.send');

    // Halaman notifikasi milik user login
    Route::get('/notif/my', [NotifController::class, 'myNotifications'])->name('notif.my');

    // Tandai notifikasi sebagai dibaca
    Route::put('/notif/read/{id}', [NotifController::class, 'markAsRead'])->name('notif.read');

    // (Opsional) lihat notifikasi user lain (buat superadmin)
    Route::get('/notif/user/{id}', [NotifController::class, 'userNotifications'])->name('notif.user');

    // 🔔 API ROUTES UNTUK NOTIFIKASI DROPDOWN
    Route::get('/notif/api/my', [NotifController::class, 'getMyNotificationsApi'])->name('notif.api.my');
    Route::put('/notif/api/read/{id}', [NotifController::class, 'markAsReadApi'])->name('notif.api.read');

    // Lowongan Magang
    Route::resource('magang', MagangController::class);
    Route::get('/api/magang/regencies/{provinceId}', [MagangController::class, 'getRegencies'])->name('magang.api.regencies');
    Route::get('/api/magang/districts/{regencyId}', [MagangController::class, 'getDistricts'])->name('magang.api.districts');
    Route::get('/api/magang/villages/{districtId}', [MagangController::class, 'getVillages'])->name('magang.api.villages');

    // Job Categories
    Route::get('/job-categories', [JobCategoryController::class, 'index'])
        ->name('job-categories.index');

    Route::get('/job-categories/create', [JobCategoryController::class, 'create'])
        ->name('job-categories.create');

    Route::post('/job-categories', [JobCategoryController::class, 'store'])
        ->name('job-categories.store');

    Route::get('/job-categories/{id}/edit', [JobCategoryController::class, 'edit'])
        ->name('job-categories.edit');

    Route::put('/job-categories/{id}', [JobCategoryController::class, 'update'])
        ->name('job-categories.update');

    Route::delete('/job-categories/{id}', [JobCategoryController::class, 'destroy'])
        ->name('job-categories.destroy');

    // Job Listings Routes
    Route::resource('job_listings', JobListingController::class);

    // Tambahan routes untuk JobListing
    Route::patch('/job-listings/{job_listing}/publish', [JobListingController::class, 'publish'])
        ->name('job_listings.publish');
    Route::patch('/job-listings/{job_listing}/set-draft', [JobListingController::class, 'setDraft'])
        ->name('job_listings.set-draft');
    Route::post('/job-listings/{job_listing}/duplicate', [JobListingController::class, 'duplicate'])
        ->name('job_listings.duplicate');
    Route::post('/job-listings/bulk-action', [JobListingController::class, 'bulkAction'])
        ->name('job_listings.bulk-action');
    Route::get('/job-listings/export', [JobListingController::class, 'export'])
        ->name('job_listings.export');

    // API endpoints untuk wilayah
    Route::get('/api/regencies/{provinceId}', [JobListingController::class, 'getRegencies'])->name('api.regencies');
    Route::get('/api/districts/{regencyId}', [JobListingController::class, 'getDistricts'])->name('api.districts');
    Route::get('/api/villages/{districtId}', [JobListingController::class, 'getVillages'])->name('api.villages');
    Route::get('/api/location-details', [JobListingController::class, 'getLocationDetails'])->name('api.location-details');
    Route::get('/api/job-stats', [JobListingController::class, 'getStats'])->name('api.job-stats');

    Route::resource('applicants', ApplicantController::class)->only(['index', 'show', 'destroy']);
    Route::put('applicants/{applicant}/status', [ApplicantController::class, 'updateStatus'])->name('applicants.update_status');

    // Halaman Manajemen Perusahaan (Admin)
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::post('companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('companies/{company:slug}', [CompanyController::class, 'show'])->name('companies.show'); // Gunakan slug
    Route::delete('companies/{company:slug}', [CompanyController::class, 'destroy'])->name('companies.destroy'); // Gunakan slug

    // Halaman Manajemen Kampus/Sekolah (Admin)
    Route::get('campus', [CampusController::class, 'index'])->name('campus.index');
    Route::get('campus/{campus:slug}', [CampusController::class, 'show'])->name('campus.show'); // Gunakan slug
    Route::delete('campus/{campus:slug}', [CampusController::class, 'destroy'])->name('campus.destroy'); // Gunakan slug
    
    // TAMBAHAN: Routes untuk Pemagang (Interns)
    Route::prefix('interns')->name('interns.')->group(function () {});

    // 4. Manajemen Jadwal/Kalender
    Route::prefix('calendar')->name('calendar.')->group(function () {
        Route::get('/', fn() => view('admin.calendar.index'))->name('index');
        Route::get('/events', [CalendarController::class, 'fetchEvents'])->name('index.events');
        Route::post('/store', [CalendarController::class, 'store'])->name('store');
        Route::patch('/update', [CalendarController::class, 'update'])->name('update');
        Route::post('/delete', [CalendarController::class, 'destroy'])->name('delete');
    });

    // 5. Laporan & Analitik
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // 6. Reference
    Route::prefix('reference')->name('reference.')->group(function () {
        Route::get('/', [ReferenceController::class, 'index'])->name('index');

        // Submenu Provinsi
        Route::prefix('provinsi')->name('provinsi.')->group(function () {
            Route::get('/', [ProvinsiController::class, 'index'])->name('index');
            Route::get('/create', [ProvinsiController::class, 'create'])->name('create');
            Route::post('/', [ProvinsiController::class, 'store'])->name('store');
            Route::get('/{id}', [ProvinsiController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [ProvinsiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProvinsiController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProvinsiController::class, 'destroy'])->name('destroy');

            // API Routes untuk Provinsi
            Route::get('/api/list', [ProvinsiController::class, 'getProvinsi'])->name('api.list');
        });

        // Submenu Kabupaten
        Route::prefix('kabupaten')->name('kabupaten.')->group(function () {
            Route::get('/', [KabupatenController::class, 'index'])->name('index');
            Route::get('/create', [KabupatenController::class, 'create'])->name('create');
            Route::post('/', [KabupatenController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [KabupatenController::class, 'edit'])->name('edit');
            Route::put('/{id}', [KabupatenController::class, 'update'])->name('update');
            Route::delete('/{id}', [KabupatenController::class, 'destroy'])->name('destroy');

            Route::get('/api/list', [KabupatenController::class, 'getKabupaten'])->name('api.list');
            Route::get('/api/provinsi/{provinsiId}', [KabupatenController::class, 'getByProvinsi'])->name('api.by-provinsi');
        });

        // Submenu Kecamatan
        Route::prefix('kecamatan')->name('kecamatan.')->group(function () {
            Route::get('/', [KecamatanController::class, 'index'])->name('index');
            Route::get('/create', [KecamatanController::class, 'create'])->name('create');
            Route::post('/', [KecamatanController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [KecamatanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [KecamatanController::class, 'update'])->name('update');
            Route::delete('/{id}', [KecamatanController::class, 'destroy'])->name('destroy');

            Route::get('/api/list', [KecamatanController::class, 'getKecamatan'])->name('api.list');
            Route::get('/api/kabupaten/{kabupatenId}', [KecamatanController::class, 'getByKabupaten'])->name('api.by-kabupaten');
        });

        // Submenu Desa
        Route::prefix('desa')->name('desa.')->group(function () {
            Route::get('/', [DesaController::class, 'index'])->name('index');
            Route::get('/create', [DesaController::class, 'create'])->name('create');
            Route::post('/', [DesaController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [DesaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [DesaController::class, 'update'])->name('update');
            Route::delete('/{id}', [DesaController::class, 'destroy'])->name('destroy');

            Route::get('/api/list', [DesaController::class, 'getDesa'])->name('api.list');
            Route::get('/api/kecamatan/{kecamatanId}', [DesaController::class, 'getByKecamatan'])->name('api.by-kecamatan');
        });
    });

    // Contact messages admin management
    Route::resource('contact-messages', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('contact-messages/{id}/restore', [AdminContactController::class, 'restore'])->name('contact-messages.restore');

    /*
    |--------------------------------------------------
    | Rute Khusus Super Admin
    |--------------------------------------------------
    */
    Route::middleware(['superadmin'])->group(function () {
        Route::get('/setting', fn() => view('admin.setting'))->name('setting');
        Route::resource('users', UserController::class);
        Route::post('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::get('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('lokasi', LokasiController::class);
    });
});

Route::prefix('api/reference')->name('api.reference.')->group(function () {
    Route::get('/provinsi/list', [LocationApiController::class, 'getProvinsiList'])->name('provinsi.list');
    Route::get('/kabupaten/by-province', [LocationApiController::class, 'getKabupatenByProvince'])->name('kabupaten.by-province');
    Route::get('/kabupaten/by-provinsi', [LocationApiController::class, 'getKabupatenByProvinsi'])->name('kabupaten.by-provinsi');
    Route::get('/kecamatan/by-kabupaten', [LocationApiController::class, 'getKecamatanByKabupaten'])->name('kecamatan.by-kabupaten');
    Route::get('/kecamatan/by-kabupaten-old', [LocationApiController::class, 'getKecamatanByKabupatenOld'])->name('kecamatan.by-kabupaten-old');
    Route::get('/desa/by-kecamatan', [LocationApiController::class, 'getDesaByKecamatan'])->name('desa.by-kecamatan');
});

/*
|--------------------------------------------------------------------------
| PANEL WAWANCARA (Prefix & Name Grouping)
|--------------------------------------------------------------------------
*/
Route::prefix('wawancara')->name('wawancara.')->middleware(['auth', 'wawancara'])->group(function () {
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', fn() => view('admin.calendar.index'))->name('index');
        Route::get('/events', [CalendarController::class, 'fetchEvents'])->name('index.events');
    });
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/applications', [UserApplicationsController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}', [UserApplicationsController::class, 'show'])->name('applications.show');
    Route::get('/applications/{id}/cv', [UserApplicationsController::class, 'cv'])->name('applications.cv');
    Route::delete('/applications/{id}', [UserApplicationsController::class, 'destroy'])->name('applications.destroy');
});