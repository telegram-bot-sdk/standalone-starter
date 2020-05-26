<?php

namespace Bot\Commands;

use Telegram\Bot\Commands\Command;

/**
 * Class Start.
 */
class Start extends Command
{
    /** @var string Command Description */
    protected string $description = 'Start command to process initial request!';

    public function handle(): void
    {
        $message = $this->getUpdate()->getMessage();
        $firstName = $message->from->first_name;

        $text = "Hey, $firstName!";

        $this->bot->sendMessage([
            'chat_id' => $message->chat->id,
            'text'    => $text,
        ]);
    }
}
