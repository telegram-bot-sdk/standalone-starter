<?php

namespace Bot\Http;

use Telegram\Bot\Bot;
use Telegram\Bot\Exceptions\TelegramSDKException;

class WebhookController
{
    /**
     * Listen for inbound webhook update.
     *
     * @throws TelegramSDKException
     *
     * @return mixed|void
     */
    public function listenForUpdate()
    {
        $update = $this->bot()->listen(true);

        // Do something with the update object or let the event listener handle it.
    }

    /**
     * Get current bot instance.
     *
     * @throws TelegramSDKException
     *
     * @return Bot
     */
    public function bot(): Bot
    {
        return telegram()->bot(get_var('bot'));
    }

    /**
     * Deny access if the request is not from Telegram.
     *
     * @throws TelegramSDKException
     */
    public function denyIfNotTelegram(): void
    {
        if (!$this->isTokenValid()) {
            header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
            exit;
        }
    }

    /**
     * Determine if the request is from Telegram.
     *
     * We verify this by checking get vars to see,
     * it has bot name and token that matches with your config.
     *
     * @throws TelegramSDKException
     *
     * @return bool
     */
    public function isTokenValid(): bool
    {
        return $this->bot()->config('token') === get_var('token');
    }
}
