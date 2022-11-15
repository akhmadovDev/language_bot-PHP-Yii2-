<?php

namespace app\controllers;

use app\components\Config;
use app\components\Telegram;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public static function hiUser(Telegram $telegram, array $user)
    {
        return match ($user['page']) {
            Config::PAGE_HOME => self::pageHome($telegram, $user)
        };
    }

    /**
     * Undocumented function
     *
     * @param Telegram $telegram
     * @param array $user
     * @return void
     */
    public static function pageHome(Telegram $telegram, array $user)
    {
        return $telegram->send($telegram->text);
    }
}
