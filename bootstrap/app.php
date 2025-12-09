<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class, // ✅ tambahkan ini
        'wawancara' => \App\Http\Middleware\WawancaraMiddleware::class,
        'auth.company' => \App\Http\Middleware\RedirectIfNotCompany::class,
        'auth.campus' => \App\Http\Middleware\RedirectIfNotCampus::class,
        'logout.for.password' => \App\Http\Middleware\LogoutForPassword::class,

    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
