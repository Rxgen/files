<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SmsService;


class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('sms', function () {
            return new SmsService();
        });    
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
