<?php

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

// dotenv
$dotenv = new Dotenv\Dotenv(realpath(__DIR__ . '/../'));
$dotenv->load();

// setup database
$database = new Illuminate\Database\Capsule\Manager;
$database->addConnection([
    'driver'   => 'mysql',
    'host' => getenv('DB_HOST', '127.0.0.1'),
    'port' => getenv('DB_PORT', '3306'),
    'database' => getenv('DB_DATABASE', 'forge'),
    'username' => getenv('DB_USERNAME', 'forge'),
    'password' => getenv('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
]);
$database->bootEloquent();
$database->setAsGlobal();
