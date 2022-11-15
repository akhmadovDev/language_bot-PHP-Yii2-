<?php

namespace app\controllers;

use app\components\Config;
use app\components\Telegram;
use JsonException;

class TelegramController extends BaseTelegramController
{
    public bool $enableCsrfValidation = false;

    /**
     * @throws JsonException
     */
    public function actionIndex(): bool|string|null
    {

        if ($this->user['role'] === Config::ROLE_USER) {
            return $this->userRun($this->telegram, $this->user);
        }


        return json_encode($this->telegram->send(
            json_encode($this->user, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT),
            CategoryController::categoryKeyboards()
        ), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }

    /**
     * User run
     * @param Telegram $telegram
     * @param array $user
     * @return null
     */
    private function userRun(Telegram $telegram, array $user)
    {
        return UsersController::hiUser($telegram, $user);
    }
}
