<?php

namespace App\Providers;

use App\Models\Notification;
use App\Repositories\Notification\NotificationRepository;
use App\Services\Notification\NotificationService;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NotificationService::class, function ($app) {
            return new NotificationService(new NotificationRepository(new Notification()));
        });
    }
}
