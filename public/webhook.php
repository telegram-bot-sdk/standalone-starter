<?php

include dirname(__DIR__).'/bootstrap.php';

use Bot\Http\WebhookController;

$webhook = new WebhookController();
$webhook->denyIfNotTelegram();
$webhook->listenForUpdate();
