<?php

namespace app\controllers;

use app\components\Config;
use app\components\Keyboard;
use yii\base\Controller;
use app\components\Telegram;
use app\models\Category;
use app\models\Users;
use Yii;

class BaseTelegramController extends Controller
{
    public Telegram $telegram;
    public array |bool $user;

    /**
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, array $config = [])
    {
        $this->id = $id;
        $this->module = $module;
        parent::__construct($id, $module, $config);

        $this->telegram = new Telegram();
        $this->user = Users::getUser($this->telegram->chat_id);
        Yii::$app->params['user'] = $this->user;

        if ($this->confirmUser() === false) {
            exit('Sizning sahifangiz nofaol');
        }
    }


    /**
     * User statusini tekshiradi
     * va user ma'lumotlari bazada bor yo'qligini
     * tekshradi
     * agar bazada bo'lsa true
     * aks holda false
     *
     * @return boolean
     */
    public function confirmUser(): bool
    {
        if ($this->user === false) {
            $this->user = $this->addNewUser();

            if ($this->user === false) {
                $this->telegram->send('Baza bilan bog\'liq xatolik iltimos @mr_Akhmadov ga murojaat qiling.');
                return false;
            }

            return true;
        }

        if ($this->user['status'] === Config::STATUS_INACTIVE) {
            $this->telegram->send('Sizning sahifangiz nofaol');
            return false;
        }

        return true;
    }

    /**
     * Create new user
     *
     * @return array|bool
     */
    public function addNewUser(): bool|array
    {
        $model = new Users();
        $model->chat_id = $this->telegram->chat_id;
        $model->username = $this->telegram->update->getChat()->username;
        $model->full_name = $this->telegram->update->getChat()->firstName;
        $model->full_name .= ' ';
        $model->full_name .= $this->telegram->update->getChat()->lastName;
        if ($model->save()) {
            return Users::getUser($this->telegram->chat_id);
        }
        return false;
    }
}