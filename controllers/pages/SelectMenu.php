<?php

namespace app\controllers\pages;

use app\components\Keyboard;
use app\components\Telegram;

class SelectMenu extends Telegram
{
    public function run(array $options = [])
    {
        if ($this->text == 'salom') {
            $this->update('salom qae', Keyboard::paginationButton());
            exit;
        }
        $this->send('salom ', Keyboard::paginationButton());
        exit;
    }
}