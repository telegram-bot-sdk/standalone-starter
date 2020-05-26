<?php

/*
|--------------------------------------------------------------------------
| Global Helpers
|--------------------------------------------------------------------------
|
| Global helper functions that you can use across your project.
|
*/

use Illuminate\Support\Arr;
use Telegram\Bot\BotManager;

/**
 * Root path of your project.
 *
 * @param  string|null  $path
 *
 * @return string
 */
function root_path(string $path = null): string
{
    return dirname(__DIR__).($path ? DIRECTORY_SEPARATOR.ltrim($path, '/') : '');
}

/**
 * Get or set configuration value using "dot" notation.
 *
 * @param  null        $key
 * @param  mixed|null  $default
 *
 * @return mixed
 */
function telegram_config($key = null, $default = null)
{
    static $config = null;

    if (null === $config) {
        $config = require root_path('config/telegram.php');
    }

    if (null === $key) {
        return $config;
    }

    if (is_array($key)) {
        foreach ($key as $name => $value) {
            Arr::set($config, $name, $value);
        }

        return true;
    }

    return Arr::get($config, $key, $default);
}

/**
 * Create a new instance of BotManager with our config file.
 *
 * @return BotManager
 */
function telegram(): BotManager
{
    static $telegram;

    return $telegram ??= new BotManager(telegram_config());
}

/**
 * Get value from GET var.
 *
 * @param $param
 *
 * @return mixed|null
 */
function get_var($param)
{
    $_GET = array_map('trim', $_GET);
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    return $_GET[$param] ?? null;
}

