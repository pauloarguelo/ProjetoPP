<?php

namespace App\Providers;

use App\Validators\AvailableBalanceValidator;
use App\Validators\CnpjValidator;
use App\Validators\CpfValidator;
use App\Validators\ValidPermissionValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap any application services and Custo Validators
     */
    public function boot()
    {
        CpfValidator::validate();
        CnpjValidator::validate();
        AvailableBalanceValidator::validate();
        ValidPermissionValidator::validate();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
