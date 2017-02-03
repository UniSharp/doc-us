<?php

namespace UniSharp\DocUs;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class DocUsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->loadViewsFrom(__DIR__ . '/views', 'schema');
    }
}
