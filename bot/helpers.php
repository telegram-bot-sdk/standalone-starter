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
use Illuminate\Container\Container;

if (!function_exists('dd')) {
    /**
     * Dump and die helper.
     *
     * @param  mixed  ...$vars
     */
    function dd(...$vars)
    {
        collect($vars)->each(static function ($var) {
            echo '<pre>';
            print_r($var);
            echo '</pre>';
        });
        die;
    }
}

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

if (!function_exists('config')) {
    /**
     * Get or set configuration value using "dot" notation.
     *
     * @param  string|array|null  $key
     * @param  mixed|null         $default
     *
     * @return mixed
     */
    function config($key = null, $default = null)
    {
        $configs = app('config');

        if (null === $key) {
            return $configs;
        }

        if (is_array($key)) {
            foreach ($key as $name => $value) {
                Arr::set($configs, $name, $value);
            }

            app()->instance('config', $configs);

            return true;
        }

        return Arr::get($configs, $key, $default);
    }
}

if (!function_exists('resolve')) {
    /**
     * Resolve a service from the container.
     *
     * @param  string  $name
     * @param  array   $parameters
     *
     * @return mixed
     */
    function resolve($name, array $parameters = [])
    {
        return app($name, $parameters);
    }
}

if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array        $parameters
     *
     * @return mixed|\Illuminate\Contracts\Container\Container
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (!function_exists('swap')) {
    /**
     * Swap the given class implementation in the container.
     *
     * @param  string  $class
     * @param  mixed   $instance
     *
     * @return void
     */
    function swap($class, $instance)
    {
        app()->instance($class, $instance);
    }
}

/**
 * Resolve BotManager from the container.
 *
 * @return BotManager
 */
function telegram(): BotManager
{
    return app('telegram');
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
    if (null === $_GET) {
        return null;
    }

    $_GET = array_map('trim', $_GET);
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    return $_GET[$param] ?? null;
}

