<?php

namespace app\controllers\pages;

use app\components\Config;
use app\components\Keyboard;
use app\components\Telegram;
use app\models\SubCategory as SubCategoryModel;
use app\models\Words;
use Exception;
use Yii;

class SubCategory extends Telegram
{
    public function run(array $options = [])
    {
        try {
            $this->beforeRun($options);

            if ($this->backCommand()) {
                return $this->goToPreviousPage();
            }

            if ($sub_category_id = $this->correctCommand()) {
                return $this->goToNextPage($sub_category_id);
            }

        } catch (Exception $e) {
            $this->send($e->getMessage());
            return false;
        }
    }

    /**
     * after run page
     *
     * @param [type] $options
     * @return void
     */
    public function beforeRun($options)
    {
        if (isset($options['text'])) {
            $this->text = $options['text'];
        }
    }

    /**
     * Go to previus page
     *
     * @return bool
     */
    private function goToPreviousPage()
    {
        $text = Yii::t('app/telegram', 'Begin');
        $home = new Home();
        return $home->run([
            'text' => $text
        ]);
    }

    /**
     * Kamnda rostligini tekshiradi
     * Asosan birinchi berilgan buyruqni tekshiradi
     * @return int|null
     */
    public function correctCommand(): ?int
    {
        $sub_category_id = SubCategoryModel::getId($this->text);

        if ($sub_category_id == null) {
            throw new Exception('Tugma tanlanmadi. Iltimos tugmalardan birini tanlang');
        }

        return $sub_category_id;
    }

    /**
     * go to next page
     *
     * @return boolean
     */
    public function goToNextPage(int $sub_category_id): bool
    {
        $words = $this->getWords($sub_category_id);
        $select_menu_keyboard = $this->selectMenuKeyboard();

        if (
            $this->updateUser([
                'page' => Config::PAGE_SELECT_MENU,
                'sub_category_id' => $sub_category_id
            ])
        ) {
            $text = "To see all the words, click on the <b>All Words</b> button \n";
            $text .= "If you want to start the test, click the <b>Start Test</b> button";
            $this->send($text, $select_menu_keyboard);
            return true;
        }

        return false;
    }

    /**
     * get words
     *
     * @param integer $sub_category_id
     * @return array
     */
    private function getWords(int $sub_category_id): array
    {
        $words = Words::get($sub_category_id);

        if (empty($words)) {
            throw new Exception('Ushbu unitda lug`at mavjud emas');
        }

        return $words;
    }

    private function selectMenuKeyboard()
    {
        return Keyboard::selectMenu();
    }
}