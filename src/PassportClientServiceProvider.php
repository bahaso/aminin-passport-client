<?php

namespace Aminin\PassportClient;

use Aminin\PassportClient\Exceptions\ExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler as Handler;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class PassportClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Do not forget to import them before using!
         */
        $this->app->bind(
            Handler::class,
            ExceptionHandler::class
        );

        $this->app->alias('passport.client', PassportClient::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
