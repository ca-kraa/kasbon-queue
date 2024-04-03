<?php

namespace App\Providers;

use App\Models\Pegawai;
use App\Repositories\KasbonRepository;
use App\Repositories\PegawaiRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PegawaiRepository::class,
            KasbonRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
