<?php

namespace Bot\Bootstrap;

use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerContract;

class Bot
{
    /**
     * @var ContainerContract
     */
    protected ContainerContract $container;

    /**
     * @var array|string[]
     */
    protected array $boostrappers = [
        \Bot\Bootstrap\LoadConfiguration::class,
        \Bot\Bootstrap\RegisterBindings::class,
    ];

    public function __construct(ContainerContract $container = null)
    {
        $this->container = $container ?? Container::getInstance();
    }

    /**
     * Bootstrap Bot.
     */
    public function bootstrap(): void
    {
        $this->loadPaths();
        $this->loadDotEnv();
        $this->bootstrapWith($this->boostrappers);
    }

    /**
     * Load paths.
     */
    public function loadPaths(): void
    {
        $this->container->instance('path', root_path());
        $this->container->instance('path.bot', root_path('bot'));
        $this->container->instance('path.public', root_path('public'));
        $this->container->instance('path.config', root_path('config'));
    }

    /**
     * Bootstrap bot with given bootstrapers.
     *
     * @param  array  $bootstrapers
     */
    public function bootstrapWith(array $bootstrapers): void
    {
        collect($bootstrapers)->each(
            fn($bootstrapper) => $this->container->make($bootstrapper)->bootstrap($this->container)
        );
    }

    /**
     * Use Dotenv to set required environment variables and load .env file in root
     */
    public function loadDotEnv(): void
    {
        $dotenv = Dotenv::createImmutable(root_path());
        if (file_exists(root_path('.env'))) {
            $dotenv->load();
        }
    }
}
