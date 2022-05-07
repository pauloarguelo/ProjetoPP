<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Wallet\WalletRepository;
use App\Services\External\ExternalAuthorizerTransaction;
use App\Services\Transaction\TransactionService;
use App\Services\Notification\NotificationService;
use Illuminate\Support\ServiceProvider;
use App\Services\Wallet\WalletService;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionService(new TransactionRepository(new Transaction()), 
            new ExternalAuthorizerTransaction(),
            New NotificationService(new NotificationRepository(new Notification())),
            new WalletService(new WalletRepository(new Wallet())));
        });
    }
}
