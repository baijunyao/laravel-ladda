<?php

namespace Baijunyao\LaravelLadda\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class LaravelLadda
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // 获取 response 内容
        $content = $response->getContent();

        // 如果没有 body 标签直接返回
        if (false === strripos($content, '</body>')) {
            return $response;
        }

        // 如果没有用到 ladda 直接返回
        if (false === strripos($content, 'js-laravel-ladda')) {
            return $response;
        }
    
        // 插入 css 标签
        $laddaCssPath = asset('statics/Ladda-1.0.6/ladda.min.css');

        $laddaCss = <<<php
<link href="$laddaCssPath" rel="stylesheet" type="text/css" />
</head>
php;

        // 插入 js 标签
        $spinJsPath = asset('statics/Ladda-1.0.6/spin.min.js');
        $laddaJsPath = asset('statics/Ladda-1.0.6/ladda.min.js');

        $laddaJs = <<<php
<script src="$spinJsPath"></script>
<script src="$laddaJsPath"></script>
<script>
    Ladda.bind('.js-laravel-ladda');
</script>
</body>
php;

        $seach = [
            '</head>',
            '</body>'
        ];
        $subject = [
            $laddaCss,
            $laddaJs
        ];
        // p($content);die;
        $content = str_replace($seach, $subject, $content);
        // 更新内容并重置Content-Length
        $response->setContent($content);
        $response->headers->remove('Content-Length');
        return $response;
    }
}
