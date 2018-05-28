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
        $this->cssFile('statics/Ladda-1.0.6/ladda.min.css')
            ->jsFile('statics/Ladda-1.0.6/spin.min.js')
            ->jsFile('statics/Ladda-1.0.6/ladda.min.js')
            ->jsContent($laddaJs);
    }

}