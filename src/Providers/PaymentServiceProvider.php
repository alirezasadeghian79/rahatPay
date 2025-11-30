<?php

namespace rahatPay\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/rahatPay.php',
            'payment'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/rahatPay.php' => config_path('rahatPay.php'),
        ], 'payment-config');

    }
}
