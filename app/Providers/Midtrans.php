<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class Midtrans extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$clientKey = config('midtrans.clientKey');
        \Midtrans\Config::$isProduction = filter_var(config('midtrans.isProduction'), FILTER_VALIDATE_BOOLEAN);
        \Midtrans\Config::$isSanitized = filter_var(config('midtrans.isSanitized'), FILTER_VALIDATE_BOOLEAN);
        \Midtrans\Config::$is3ds = filter_var(config('midtrans.is3ds'), FILTER_VALIDATE_BOOLEAN);
    }
}
