<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    public function boot(): void {
        if ($this->app->environment('production')) { \Illuminate\Support\Facades\URL::forceScheme('https'); }
    }
    public function register(): void
    {
        //
    }
}


