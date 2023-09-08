<?php

namespace App\Providers;

use App\Services\Service\Wallet\WalletService;
use App\Services\ServiceInterface\Wallet\WalletServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WalletServiceInterface::class, WalletService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
