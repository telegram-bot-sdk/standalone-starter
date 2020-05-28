<?php

namespace Bot\Bootstrap;

use Telegram\Bot\Bot;
use Telegram\Bot\Api;
use Telegram\Bot\BotManager;
use Illuminate\Contracts\Container\Container;

class RegisterBindings
{
    public function bootstrap(Container $container): void
    {
        $container->bind(BotManager::class, fn($app) => (new BotManager(config('telegram')))->setContainer($app));
        $container->alias(BotManager::class, 'telegram');

        $container->bind(Bot::class, fn($app) => $app[BotManager::class]->bot());
        $container->alias(Bot::class, 'telegram.bot');

        $container->bind(Api::class, fn($app) => $app[Bot::class]->getApi());
        $container->alias(Api::class, 'telegram.api');
    }
}
