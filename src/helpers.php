<?php

if (!function_exists('ladda')){
    /**
     * 添加成功提示
     *
     * @param string $name
     */
    function ladda($name = '')
    {
        echo $name;die;
        // 如果指定 name  则使用指定的 name 否则使用配置项中的默认值
        $name = empty($expression) ? config('ladda.name') : $expression;
        // 获取style
        $style = config('ladda.style');
        // 获取 html 标签
        $html = file_get_contents(resource_path('views/vendor/ladda/submit.blade.php'));
        return str_replace(['#submit#', '#style#'], [$name, $style], $html);
    }
}
