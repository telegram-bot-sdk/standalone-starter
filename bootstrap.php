<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on.
|
*/

require __DIR__.'/vendor/autoload.php';

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
if (file_exists(__DIR__.'/.env')) {
    $dotenv->load();
}
