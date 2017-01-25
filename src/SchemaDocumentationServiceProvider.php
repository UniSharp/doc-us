<?php

namespace UniSharp\SchemaDocumentation;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class SchemaDocumentationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->loadViewsFrom(__DIR__ . '/views', 'schema');
    }
}
