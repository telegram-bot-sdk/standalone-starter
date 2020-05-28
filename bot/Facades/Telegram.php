<?php

namespace Bot\Facades;

use Bot\Bootstrap\Facade;
use Telegram\Bot\BotManager;

/**
 * Class Telegram
 *
 * @mixin BotManager
 */
class Telegram extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return BotManager::class;
    }
}
