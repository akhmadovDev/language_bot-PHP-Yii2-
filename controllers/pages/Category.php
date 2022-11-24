<?php

namespace app\controllers\pages;

use app\components\Telegram;
use app\components\Config;
use app\models\Category as CategoryModel;
use app\models\SubCategory;
use app\components\Keyboard;
use Exception;
use Yii;

class Category extends Telegram
{
    /**
     * Run Category page
     *
     * @param array $options
     * @return bool
     */
    public function run(array $options = [])
    {
        try {

            $this->afterRun($options);

            if ($this->backCommand()) {
                return $this->goToPreviousPage();
            }

            if ($category_id = $this->correctCommand()) {
                return $this->goToNextPage($category_id);
            }

            throw new Exception('Iltimos pastdagi tugmalardan birini tanlang');

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
    public function afterRun($options)
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
        $text = Yii::t('app/telegram', 'Welcome');
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
        $category_id = CategoryModel::getId($this->text);

        if ($category_id == null) {
            throw new Exception('Xato buyruq kiritildi. Iltimos tugmalardan birini tanlang');
        }

        return $category_id;
    }

    /**
     * go to next page
     *
     * @return boolean
     */
    public function goToNextPage(int $category_id): bool
    {
        $sub_categories = $this->getSubCategories($category_id);
        $sub_category_keyboards = $this->subCategoriesKeyboard($sub_categories);

        if ($this->updatePage(Config::PAGE_SUB_CATEGORY)) {
            $this->send(Yii::t('app/telegram', 'Sub kategoriyalardan birini tanlang'), $sub_category_keyboards);

            return true;
        }

        return false;
    }

    /**
     * Sub kategoriya bazada bor yo'qligini tekshiradi
     * agar ma'lumot bor bo'lsa sub kategoriyalarni qaytaradi
     * aks holda exception yozadi
     *
     * @param integer $category_id
     * @return array
     */
    private function getSubCategories(int $category_id)
    {
        $sub_category = SubCategory::getAll($category_id);

        if (empty($sub_category)) {
            throw new Exception('Ushbu kategoriyaga tegishli ma`lumot mavjud emas!');
        }

        return $sub_category;
    }

    /**
     * Kategoriyalarni keyboard shakliga o'tkazadi
     *
     * @param array $categories
     * @return Keyboard
     */
    public function subCategoriesKeyboard(array $categories): Keyboard
    {
        return Keyboard::keyboard($categories);
    }

}