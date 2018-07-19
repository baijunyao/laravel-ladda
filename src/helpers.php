<?php

use Baijunyao\LaravelLadda\Ladda;

if (!function_exists('ladda_submit')){
    /**
     * submit 按钮
     *
     * @param string $name
     */
    function ladda_submit($name = '', $class = '')
    {
        return Ladda::submit($name, $class);
    }
}

if (!function_exists('ladda_button')){
    /**
     * button 按钮
     *
     * @param string $name
     */
    function ladda_button($name = '', $class = '')
    {
        return Ladda::button($name, $class);
    }
}
