<?php

namespace Baijunyao\LaravelLadda;

class Ladda
{
    /**
     * 生成按钮 html
     * 
     * @param string $name
     * @param string $class
     * @param string $type
     *
     * @return mixed
     */
    static public function create($name = '', $class = '', $type = 'submit')
    {
        // 如果指定 name  则使用指定的 name 否则使用配置项中的默认值
        $name = empty($name) ? config('laravel-ladda.name') : $name;
        // 获取style
        $style = config('laravel-ladda.style');
        // 获取 html 标签
        $html = file_get_contents(resource_path('views/vendor/laravel-ladda/submit.blade.php'));
        return str_replace(['#class#', '#style#', '#type#', '#name#'], [$class, $style, $type, $name], $html);
    }

    /**
     * 生成 submit 按钮
     *
     * @param string $name
     * @param string $class
     *
     * @return mixed
     */
    static public function submit($name = '', $class = '')
    {
        return self::create($name, $class, 'submit');
    }

    /**
     * 生成 button 按钮
     *
     * @param string $name
     * @param string $class
     *
     * @return mixed
     */
    static public function button($name = '', $class = '')
    {
        return self::create($name, $class, 'button');
    }
}