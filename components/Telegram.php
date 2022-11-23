<?php

namespace app\components;

use Telegram\Bot\Api;
use Yii;
use Telegram\Bot\Objects\Update as UpdateObject;
use Telegram\Bot\Objects\Message;
use app\components\Config;
use app\models\Users;
use Exception;

class Telegram extends Api
{
    public UpdateObject $update;
    public int $chat_id;
    public string $chat_type;
    public string $text;
    public Config $config;

    public function __construct()
    {
        $this->config = new Config();

        parent::__construct($this->config::TELEGRAM_BOT_TOKEN);

        $this->update = $this->getWebhookUpdate();
        $this->chat_id = $this->update->getChat()->id;
        $this->chat_type = $this->update->getChat()->type;
        $this->text = $this->update->getMessage()->text;

        $this->checkChatType($this->chat_type) === false ? exit('kirish xuquqi mavjud emas') : '';
    }

    /**
     * Send Message
     *
     * @param string $text
     * @param Keyboard $keyboard
     * @return Message
     */
    public function send(string $text, ? Keyboard $keyboard = null): Message
    {
        return $this->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => $keyboard,
            'parse_mode' => 'HTML'
        ]);
    }

    /**
     * Chat turi private bo'lsa true qaytaradi 
     * qolgan hollarda channel, supergroup, group
     * false qaytaradi
     *
     * @param string $chat_type
     * @return bool
     */
    public function checkChatType(string $chat_type): bool
    {
        if ($chat_type === $this->config::CHAT_TYPE_PRIVATE) {
            return true;
        }

        $this->send('kirish xuquqi mavjud emas');
        return false;
    }

    ///////////------------------////////////////////
    /**
     * Update page
     *
     * @return bool
     */
    protected function updatePage(int $page): bool
    {
        $user_id = Yii::$app->params['user']['id'];
        $update_page = Users::updatePage($page, $user_id);

        if ($update_page < 1) {
            throw new Exception('Qandaydir xatolik sodir bo`ldi. User sahifasi o`zgartirilmadi. Iltimos @mr_Akhmadov ga murojaat qiling');
        }

        return true;
    }
}