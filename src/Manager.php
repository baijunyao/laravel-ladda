<?php

namespace Baijunyao\LaravelLadda;

use Baijunyao\LaravelPluginManager\Contracts\PluginManager;

class Manager extends PluginManager
{
    protected $element = 'js-laravel-ladda';

    protected function load()
    {
        $laddaJs = <<<php
Ladda.bind('.js-laravel-ladda');
php;
        $this->cssFile('statics/laravel-ladda/ladda.min.css')
            ->jsFile('statics/laravel-ladda/spin.min.js')
            ->jsFile('statics/laravel-ladda/ladda.min.js')
            ->jsContent($laddaJs);
    }

}