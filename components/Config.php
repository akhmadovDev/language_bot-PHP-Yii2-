<?php

namespace app\components;

use yii\base\Component;

class Config extends Component
{
    /**
     * Configuration constants
     */
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    /**
     * Roles
     */
    public const ROLE_USER = 9;
    public const ROLE_ADMIN = 10;

    /**
     * Pages
     */
    public const PAGE_WELCOME = 2;
    public const PAGE_LANGUAGE = 3;
    public const PAGE_HOME = 4;
    public const PAGE_CATEGORY = 5;
    public const PAGE_SUB_CATEGORY = 6;
    public const PAGE_TEST = 7;
    public const PAGE_WORDS = 8;
    public const PAGE_SELECT_MENU = 9;


    /**
     * Current date
     *
     * @return string
     */
    public static function currentDateTime(): string
    {
        return date('Y-m-d H:i:s');
    }


    /*************************  Telegram configurate start ************************
     * Telegram bot token
     */
    public const TELEGRAM_BOT_TOKEN = '5719296492:AAES-Dw8TkY7IQZZvbHOOSIVtoKc6SuNjL8';

    /**
     * Chat type
     */
    public const CHAT_TYPE_SUPERGROUP = 'supergroup';
    public const CHAT_TYPE_GROUP = 'group';
    public const CHAT_TYPE_PRIVATE = 'private';
    public const CHAT_TYPE_CHANNEL = 'channel';

    /**
     * Keyboards
     */
    public const BACK = '🔙Orqaga';
    public const ALL_WORDS = 'All Words';
    public const START_TEST = 'Start Test';
}