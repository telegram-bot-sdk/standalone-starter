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

use Bot\Bootstrap\Bot;
use Illuminate\Container\Container;

Container::setInstance(new Container);

Container::getInstance()->make(Bot::class)->bootstrap();
