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
- Copy `.env.example` to `.env` and configure your token and domain.
- Explore `config/telegram.php`
- Build bots!

## Directory Structure

```
.
├── bot
│   ├── Commands - Bot commands.
│   ├── Console - CLI console commands.
│   ├── Http - Bot controllers.
│   └── Listeners - Event Listeners.
├── config - Config files.
└── public - Public facing files.
```

## Webhook Setup

> **IMPORTANT:** Telegram requires your domain to have an SSL certificate (https) to setup a webhook.

The standalone starter comes with a CLI helper to setup webhook for your bot. Simply fire the below command.

```bash
php telegram webhook:setup <botname>
```

This will setup a webhook with a URL example:

```
https://domain.com/webhook.php?token=YourBotToken&bot=YourBotName
```

The webhook file will verify any inbound requests to make sure its a valid request from Telegram.
It'll deny any other requests. So you need not have to worry.

You can process inbound updates either using an event listener or directly in the given `bot/Http/WebhookController.php` in `listenForUpdate()` method.

## License

This project is released under the [BSD 3-Clause](LICENSE.md) License.
