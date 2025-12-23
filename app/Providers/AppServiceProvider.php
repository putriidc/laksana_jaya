<?php

namespace App\Providers;

use App\Models\Perusahaan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('kepala-proyek.layout', function ($view) {
            $view->with('sidebarPerusahaans', Perusahaan::whereNull('deleted_at')->get());
        });
        View::composer('owner.layout', function ($view) {
            $view->with('sidebarPerusahaans', Perusahaan::whereNull('deleted_at')->get());
        });
    }
}
