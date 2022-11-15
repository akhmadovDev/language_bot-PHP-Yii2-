<?php

namespace app\components;

use Telegram\Bot\Api;
use Yii;
use Telegram\Bot\Objects\Update as UpdateObject;
use app\components\Config;

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
     * @param array|null $keyboard
     * @return void
     */
    public function send(string $text, $keyboard = null)
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
}
