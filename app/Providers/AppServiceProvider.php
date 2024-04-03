<?php

namespace App\Providers;

use App\Models\Kasbon;
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
        $this->app->singleton(PegawaiRepository::class, function ($app) {
            return new PegawaiRepository($app->make(Pegawai::class));
        });

        $this->app->singleton(KasbonRepository::class, function ($app) {
            return new KasbonRepository($app->make(Kasbon::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
