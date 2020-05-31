# Standalone Starter - Telegram Bot SDK

> Standalone starter for [Telegram Bot SDK](https://github.com/telegram-bot-sdk/telegram-bot-sdk) to create Telegram Bots in PHP.

## Features

- Multi-Bots.
- Webhook.
- Updates Polling.
- Commands.
- Event Listener.

## Usage

```bash
composer create-project telegram-bot-sdk/standalone-starter mybot
```

- Create a bot with Botfather.
- Open `.env` and configure your token and domain (Copy `.env.example` if you have cloned this project).
- Explore `config/telegram.php`
- Follow docs.
- Build bots!

### Helpers

The starter comes with some useful helpers for convenience that can be found in `bot/helpers.php`.

- `telegram()` - Get an instance of BotManager from the container.

## Directory Structure

```
.
├── .env - Project environment variable.
├── bootstrap - Bot bootstrapping files.
├── bot - Your bot main files.
│   ├── Commands - Bot commands.
│   ├── Console - CLI console commands.
│   ├── Facades - Bot Facades.
│   ├── Http - Bot controllers.
│   └── Listeners - Event Listeners.
├── config - Config files.
|   └── telegram.php - Your main SDK configuration.
└── public - Public facing files.
    └── index.php - Project index file.
    └── pooling.php - Long-pooling update handler.
    └── webhook.php - Webhook update handler.
```

## Webhook Setup

> **IMPORTANT:** Telegram requires your domain to have an SSL certificate (https) to setup a webhook.

Open `.env` and fill your webhook URL with :

```
TELEGRAM_WEBHOOK_DOMAIN=<https://yourdomain.com>
```

The standalone starter comes with a CLI helper to setup webhook for your bot. Simply fire the below command.

```bash
php telegram webhook:setup <botname>
```

This will setup a webhook with a URL example:

```
<https://yourdomain.com>/webhook.php?token=YourBotToken&bot=YourBotName
```

The webhook file will verify any inbound requests to make sure its a valid request from Telegram.
It'll deny any other requests. So you need not have to worry.

You can process inbound updates either using an event listener or directly in the given `bot/Http/WebhookController.php` in `listenForUpdate()` method.

## License

This project is released under the [BSD 3-Clause](LICENSE.md) License.
