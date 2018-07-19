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
        // 发布静态资源文件
        $this->publishes([
            __DIR__.'/resources/statics' => public_path('statics'),
        ], 'public');

        // 发布 前端页面 组件
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/ladda'),
        ]);

        // 发布配置项
        $this->publishes([
            __DIR__.'/config/ladda.php' => config_path('ladda.php'),
        ]);

        // 自定义 ladda 标签
        Blade::directive('ladda', function ($expression) {
            $expression = explode(',', str_replace(['"', "'", " "], '', $expression));
            $name = empty($expression[0]) ? config('ladda.name') : $expression[0];
            $class = empty($expression[1]) ? '' : $expression[1];
            return ladda($name, $class);
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
