<?php

namespace app\controllers;

use app\components\Telegram;

class UserController
{
    public function __construct(
        private Telegram $telegram,
        private array $user
    ) {
        $telegram->send('hi bu user controller');
    }
}
