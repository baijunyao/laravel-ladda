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

        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware(LaravelLadda::class);

        // 自定义 ladda 标签
        Blade::directive('ladda', function ($expression) {
            // 如果指定 name  则使用指定的 name 否则使用配置项中的默认值
            $name = empty($expression) ? config('ladda.name') : $expression;
            // 获取style
            $style = config('ladda.style');
            // 获取 html 标签
            $html = file_get_contents(resource_path('views/vendor/ladda/submit.blade.php'));
            return str_replace(['#submit#', '#style#'], [$name, $style], $html);
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
