<?php

namespace mastani\IDPay;

use Illuminate\Support\ServiceProvider;

class IDPayServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(IDPay::class, function () {
            return new IDPay();
        });

        $this->app->alias(IDPay::class, 'idpay');
    }
}