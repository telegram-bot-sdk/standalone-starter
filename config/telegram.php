<?php

return [

    /**
     *--------------------------------------------------------------------------
     * Default Bot Name
     *--------------------------------------------------------------------------
     *
     * Here you may specify which of the bots below you wish to use as
     * your default bot for regular use. Of course, you may use many
     * bots at once using the manager class.
     *
     */

    'use' => 'default',

    /**
     *--------------------------------------------------------------------------
     * Your Telegram Bots
     *--------------------------------------------------------------------------
     *
     * You may use multiple bots at once using the manager class. Each bot
     * that you own should be configured here.
     *
     * Here are each of the telegram bots config parameters.
     *
     * Supported Params:
     *
     * - name: The *personal* name you would like to refer to your bot as.
     *
     *       - token:    Your Telegram Bot Token.
     *                   Refer for more details: https://core.telegram.org/bots#botfather
     *                   Example: (string) '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11'.
     *
     *       - commands: (Optional) Commands to register for this bot,
     *                   Supported Values: "Command Group Name", "Command Repository Name", "Command => Full Path to Class".
     *                   Default: Registers Global Commands.
     *                   Example: (array) [
     *                       'admin', // Command Group Name.
     *                       'status', // Command Repository Name.
     *                       'hello' => Acme\Project\Commands\HelloCommand::class,
     *                       'bye'   => Acme\Project\Commands\ByeCommand::class,
     *                   ]
     */

    'bots' => [
        'default' => [
            'token'    => env('TELEGRAM_BOT_TOKEN', 'YOUR-BOT-TOKEN'),

            'commands' => [
                'start' => Bot\Commands\Start::class,
            ],

            'listen' => [
                // Example of various events fired.
                'update'        => [],
                'message'       => [],

                // Example listener for inbound photo uploads.
                'message.photo' => [
                    Bot\Listeners\ProcessInboundPhoto::class,
                ],
            ],
        ],

        'second' => [
            'token'    => '123456:abc',
            'commands' => [],
        ],
    ],

    /**
     *--------------------------------------------------------------------------
     * Webhook [Optional]
     *--------------------------------------------------------------------------
     *
     * Domain: If you want to set a custom domain for your webhook.
     *
     * You can also set Telegram webhook config before running the webhook setup.
     *
     */

    'webhook' => [
        'domain' => env('TELEGRAM_WEBHOOK_DOMAIN', null),
    ],

    /**
     *--------------------------------------------------------------------------
     * HTTP [Optional]
     *--------------------------------------------------------------------------
     *
     * - config: To set HTTP Client config (Ex: proxy).
     * - async: When set to True, All the requests would be made non-blocking (Async).
     * - api_url: To set the Base API URL.
     * - client: To set HTTP Client. Should be an instance of @see \Telegram\Bot\Contracts\HttpClientInterface::class
     *
     */

    'http' => [
        'config'  => [],
        'async'   => env('TELEGRAM_ASYNC_REQUESTS', false),
        'api_url' => 'https://api.telegram.org',
        'client'  => \Telegram\Bot\Http\GuzzleHttpClient::class,
    ],

    /**
     *--------------------------------------------------------------------------
     * Register Global Commands [Optional]
     *--------------------------------------------------------------------------
     *
     * If you'd like to use the SDK's built in command handler system,
     * You can register all the global commands here.
     *
     * Global commands will apply to all the bots in system and are always active.
     *
     * The command class should extend the \Telegram\Bot\Commands\Command class.
     *
     * Default: The SDK registers, a help command which when a user sends /help
     * will respond with a list of available commands and description.
     *
     */

    'commands' => [
        'help' => Telegram\Bot\Commands\HelpCommand::class,
    ],

    /**
     *--------------------------------------------------------------------------
     * Command Groups [Optional]
     *--------------------------------------------------------------------------
     *
     * You can organize a set of commands into groups which can later,
     * be re-used across all your bots.
     *
     * You can create [4] types of groups!
     *
     * 1. Group using full path to command classes.
     *
     * 2. Group using command repository: Provide the key name of the command from the command repository
     * and the system will automatically resolve to the appropriate command.
     *
     * 3. Group using other groups of commands: You can create a group which uses other
     * groups of commands to bundle them into one group.
     *
     * 4. You can create a group with a combination of 1, 2 and 3 all together in one group.
     *
     * Examples shown below are by the group type for you to understand each of them.
     */

    'command_groups' => [
    ],

    /**
     *--------------------------------------------------------------------------
     * Command Repository [Optional]
     *--------------------------------------------------------------------------
     *
     * Command Repository lets you register commands that can be shared between,
     * one or more bots across the project.
     *
     * This will help you prevent from having to register same set of commands,
     * for each bot over and over again and make it easier to maintain them.
     *
     * Command Repository are not active by default, You need to use the key name to register them,
     * individually in a group of commands or in bot commands.
     *
     * Think of this as a central storage, to register, reuse and maintain them across all bots.
     *
     */

    'command_repository' => [
        // 'start' => Acme\Project\Commands\StartCommand::class,
        // 'stop' => Acme\Project\Commands\StopCommand::class,
    ],
];
