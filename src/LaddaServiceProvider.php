<?php

namespace Baijunyao\LaravelLadda;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Baijunyao\LaravelLadda\Middleware\LaravelLadda;
use Illuminate\Support\Facades\Blade;
use Baijunyao\LaravelLadda\Ladda;

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
            __DIR__.'/resources/views' => resource_path('views/vendor/laravel-ladda'),
        ]);

        // 发布配置项
        $this->publishes([
            __DIR__.'/config/laravel-ladda.php' => config_path('laravel-ladda.php'),
        ]);

        // 自定义 submit 按钮标签
        Blade::directive('laddasubmit', function ($expression) {
            $expression = explode(',', str_replace(['"', "'", " "], '', $expression));
            $name = empty($expression[0]) ? config('laravel-ladda.name') : $expression[0];
            $class = empty($expression[1]) ? '' : $expression[1];
            return Ladda::submit($name, $class);
        });

        // 自定义 button 按钮标签
        Blade::directive('laddabutton', function ($expression) {
            $expression = explode(',', str_replace(['"', "'", " "], '', $expression));
            $name = empty($expression[0]) ? config('laravel-ladda.name') : $expression[0];
            $class = empty($expression[1]) ? '' : $expression[1];
            return Ladda::button($name, $class);
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
