<?php

namespace App\Providers;

use App\Models\Pegawai;
use App\Repositories\PegawaiRepository;
use App\Repositories\PegawaiRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PegawaiRepositoryInterface::class,
            PegawaiRepository::class
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
