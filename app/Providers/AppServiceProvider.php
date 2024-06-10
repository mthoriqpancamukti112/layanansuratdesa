<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Surat;
use App\Models\SuratPenduduk;

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
        View::composer('*', function ($view) {
            $view->with('surats', Surat::all());
        });

        // Menambahkan Composer untuk semua view
        View::composer('*', function ($view) {
            $notifications = SuratPenduduk::with(['user', 'surat'])
                ->where('status', 'diproses')
                ->orderBy('created_at', 'desc')
                ->get();
            $view->with('notifications', $notifications);
        });
    }
}
