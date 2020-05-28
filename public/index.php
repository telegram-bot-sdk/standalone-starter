<?php

require dirname(__DIR__).'/bootstrap.php';

use Bot\Facades\Telegram;

// Default bot
// Using facade as an example.
$defaultBot = Telegram::getMe();

// Second bot
// Using helper method
// $secondBot = telegram()->bot('second')->getMe();
