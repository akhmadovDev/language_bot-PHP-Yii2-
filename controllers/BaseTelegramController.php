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
    public array|bool $user;

    public function __construct($id, $module, $config = [])
    {
        $this->id = $id;
        $this->module = $module;
        parent::__construct($id, $module, $config);

        $this->telegram = new Telegram();
        $this->user = Users::getUser($this->telegram->chat_id);

        $this->confirmUser($this->user) === false ? exit('Sizning sahifangiz nofaol') : '';
    }

    public function categoryKeyboards()
    {
        $categories = Category::getCategtory();
        return Keyboard::keyboard($categories);
    }

    /**
     * User statusini tekshiradi 
     * va user ma'lumotlari bazada bor yo'qligini 
     * tekshradi
     * agar bazada bo'lsa true
     * aks holda false
     *
     * @param array $user
     * @return boolean
     */
    public function confirmUser(): bool
    {
        if ($this->user === false) {
            $this->user = $this->addNewUser();
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
     * @return void
     */
    public function addNewUser()
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
    }
}
