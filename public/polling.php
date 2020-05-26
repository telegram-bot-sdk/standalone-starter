<?php

require dirname(__DIR__).'/bootstrap.php';

$updates = telegram()->bot(get_var('bot'))->listen();

// Do something with the updates.
