<?php

namespace app\controllers;

use app\components\Config;
use app\components\Telegram;
use app\controllers\UsersController;
use JsonException;

class TelegramController extends BaseTelegramController
{
    public bool $enableCsrfValidation = false;

    /**
     * @throws JsonException
     */
    public function actionIndex()
    {

        if ($this->user['role'] === Config::ROLE_USER) {
            return $this->userRun($this->telegram, $this->user);
        }
    }

    /**
     * User run
     * @param Telegram $telegram
     * @param bool
     */
    private function userRun(Telegram $telegram, array $user)
    {
        return UsersController::hiUser($telegram, $user);
    }
}
