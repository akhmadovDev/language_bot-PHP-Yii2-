<?php

namespace app\controllers;

use app\components\Config;
use app\components\Telegram;

class TelegramController extends BaseTelegramController
{
    public $enavleCsrfValidation = false;

    public function actionIndex()
    {

        if ($this->user['role'] === Config::ROLE_USER) {
            return $this->userRun($this->telegram, $this->user);
        }


        return json_encode($this->telegram->send(
            json_encode($this->user, JSON_PRETTY_PRINT),
            $this->categoryKeyboards()
        ), JSON_PRETTY_PRINT);
    }

    private function userRun(Telegram $telegram, array $user)
    {
        return UsersController::hiUser($telegram, $user);
    }
}
