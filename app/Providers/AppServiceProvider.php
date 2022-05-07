<?php

namespace App\Providers;

use App\Validators\CnpjValidator;
use App\Validators\CpfValidator;
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
