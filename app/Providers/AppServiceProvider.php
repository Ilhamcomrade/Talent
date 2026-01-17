<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\Profile;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Untuk pagination Bootstrap 5
        Paginator::useBootstrap();

        // Set bahasa Indonesia untuk tanggal Carbon
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'id');

        // Share profile data with all views
        View::composer('*', function ($view) {
            $profile = Profile::first();

            // Jika tidak ada data, buat data default
            if (!$profile) {
                $profile = Profile::create([
                    'address' => 'Jl. Pratista Utara III No.2, Antapani Kidul, Kec. Antapani, Kota Bandung, Jawa Barat, Indonesia 4029',
                    'email' => 'corporate@inotal.tech',
                    'phone' => '+(62) 82115179879',
                    'operation_hours' => 'Senin - Jumat, 08.00 - 16.00 WIB',
                    'latitude' =>  -6.925457980196308,
                    'longitude' =>   107.66299344598612,
                    'map_popup_text' => 'PT INOTAL SISTEMA INTERNASIONAL Jl. Pratista Utara III No.2, Antapani.',
                    'logo_navbar_public' => null,
                    'logo_navbar_company' => null,
                    'logo_navbar_campus' => null,
                    'logo_footer' => null,
                ]);
            }

            $view->with('profile', $profile);
        });
    }
}
