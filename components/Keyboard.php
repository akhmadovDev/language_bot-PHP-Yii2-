<?php

namespace app\components;

use Telegram\Bot\Keyboard\Keyboard as BaseKeyboard;
use Yii;

class Keyboard extends BaseKeyboard
{
    public static function keyboard($data)
    {
        $dataCount = count($data);

        $keyboard = Keyboard::make();

        if ($dataCount % 2 === 0) {
            for ($i = 0; $i < $dataCount; $i += 2) {
                $keyboard->row(
                    Keyboard::inlineButton(['text' => $data[$i]['name']]),
                    Keyboard::inlineButton(['text' => $data[$i + 1]['name']])
                );
            }
        } else {
            for ($i = 0; $i < $dataCount - 1; $i += 2) {
                $keyboard->row(
                    Keyboard::inlineButton(['text' => $data[$i]['name']]),
                    Keyboard::inlineButton(['text' => $data[$i + 1]['name']])
                );
            }
            $keyboard->row(
                Keyboard::inlineButton(['text' => end($data)['name']]),
            );
        }
        $keyboard->row(
            Keyboard::button(['text' => '🔙Orqaga']),
        );

        return $keyboard->setResizeKeyboard(true)->setOneTimeKeyboard(false);
    }


    /**
     * Home keyboard
     *
     * @return Keyboard
     */
    public static function home()
    {
        $keyboard = Keyboard::make();
        $keyboard->row(
            Keyboard::button(['text' => Yii::t('app', 'Begin')])
        );

        return $keyboard->setResizeKeyboard(true)->setOneTimeKeyboard(false);
    }

    /**
     * Back keyboard
     *
     * @return void
     */
    public static function back()
    {
        $keyboard = Keyboard::make();
        $keyboard->row(
            Keyboard::button(['text' => Config::BACK])
        );

        return $keyboard->setResizeKeyboard(true)->setOneTimeKeyboard(false);
    }

    /**
     * Select menu keyboard
     *
     * @return Keyboard
     */
    public static function selectMenu()
    {
        $keyboard = Keyboard::make();
        $keyboard->row(
            Keyboard::button(['text' => Config::ALL_WORDS]),
            Keyboard::button(['text' => Config::START_TEST]),
        );

        return $keyboard->setResizeKeyboard(true)->setOneTimeKeyboard(false);
    }

    /**
     * Pagination button
     *
     * @return Keyboard
     */
    public static function paginationButton()
    {
        return Keyboard::make()
            ->inline()
            ->row(
                Keyboard::inlineButton(['text' => 'Before', 'callback_data' => 'data']),
                Keyboard::inlineButton(['text' => 'Next', 'callback_data' => 'data_from_btn2'])
            );
    }
}