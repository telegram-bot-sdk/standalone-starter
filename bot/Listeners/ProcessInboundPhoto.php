<?php

namespace Bot\Listeners;

use Telegram\Bot\Events\UpdateEvent;

class ProcessInboundPhoto
{
    /**
     * Handle the event.
     *
     * @param  UpdateEvent  $event
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(UpdateEvent $event)
    {
        $update = $event->update;
        $bot = $event->bot;

        // Process the inbound photo sent by the user.

        // Reply the user.
        $text = 'Thanks for uploading the pic!';
        $bot->sendMessage([
            'chat_id' => $update->getMessage()->chat->id,
            'text'    => $text,
        ]);
    }
}
