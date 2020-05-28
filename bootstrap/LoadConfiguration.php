<?php

namespace Bot\Bootstrap;

use SplFileInfo;
use RegexIterator;
use Illuminate\Support\Arr;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Class LoadConfiguration
 *
 * Based of Laravel
 */
class LoadConfiguration
{
    /**
     * @param  Container  $container
     *
     * @throws BindingResolutionException
     */
    public function bootstrap(Container $container): void
    {
        $config = [];
        collect($this->getConfigurationFiles($container))->each(static function ($path, $key) use (&$config) {
            Arr::set($config, $key, require $path);
        });

        $container->instance('config', $config);
    }

    /**
     * Get all of the configuration files for the application.
     *
     * @param  Container  $container
     *
     * @throws BindingResolutionException
     * @return array
     */
    public function getConfigurationFiles(Container $container): array
    {
        $files = [];

        $configPath = $container->make('path.config');

        $filesIterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($configPath), RecursiveIteratorIterator::CHILD_FIRST
        );

        /** @var SplFileInfo $file */
        foreach (new RegexIterator($filesIterator, '/.*.php$/') as $file) {
            $directory = $this->getNestedDirectory($file, $configPath);

            $files[$directory.$file->getBasename('.php')] = $file->getRealPath();
        }

        ksort($files, SORT_NATURAL);

        return $files;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param  SplFileInfo  $file
     * @param  string       $configPath
     *
     * @return string
     */
    public function getNestedDirectory(SplFileInfo $file, $configPath): string
    {
        $directory = $file->getPath();

        if ($nested = trim(str_replace($configPath, '', $directory), DIRECTORY_SEPARATOR)) {
            $nested = str_replace(DIRECTORY_SEPARATOR, '.', $nested).'.';
        }

        return $nested;
    }
}
