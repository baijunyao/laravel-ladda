<?php

namespace Baijunyao\LaravelLadda;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Baijunyao\LaravelLadda\Middleware\LaravelLadda;
use Illuminate\Support\Facades\Blade;

class LaddaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/resources/statics' => public_path('statics'),
        ], 'public');
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware(LaravelLadda::class);
        Blade::directive('ladda', function ($expression) {
            return file_get_contents(resource_path('verdor/ladda/submit.blade.php'));
        });
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
