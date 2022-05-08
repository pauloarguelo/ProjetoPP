<?php

namespace App\Providers;

use App\Models\Wallet;
use App\Repositories\Wallet\WalletRepository;
use App\Services\Wallet\WalletService;
use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WalletService::class, function ($app) {
            return new WalletService(new WalletRepository(new Wallet()));
        });
    }
}
