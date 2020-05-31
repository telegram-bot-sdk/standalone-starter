<?php

namespace Bot\Console;

use Telegram\Bot\Bot;
use Telegram\Bot\Exceptions\TelegramSDKException;

class Webhook
{
    protected Bot $bot;

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * Setup Webhook.
     *
     * @throws TelegramSDKException
     * @return bool
     */
    public function setup(): bool
    {
        // Bot webhook config.
        $config = $this->bot->config('webhook', []);

        // Global webhook config merged with bot config with the latter taking precedence.
        $params = collect($this->bot->config('global.webhook'))->except(['domain', 'path', 'controller', 'url'])
            ->merge($config)
            ->put('url', $this->url())
            ->all();

        if ($this->bot->setWebhook($params)) {
            exit('Webhook setup successful!');
        }

        exit('Failed to setup webhook!');
    }

    protected function url(): string
    {
        if (filled($this->bot->config('webhook.url'))) {
            return $this->bot->config('webhook.url');
        }

        $domain = $this->bot->config('global.webhook.domain');

        if ($domain === null) {
            exit('No domain setup for webhook. Please set one and rerun!');
        }

        $params = http_build_query([
            'token' => $this->bot->config('token'),
            'bot'   => $this->bot->config('bot'),
        ]);

        return sprintf("%s/webhook.php?%s", $domain, $params);
    }
}
