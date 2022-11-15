<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use app\components\Telegram;

$telegram = new Telegram();

$telegram->sendMessage([
    'chat_id' => 941327405,
    'text' => 'salom'
]);
exit;
