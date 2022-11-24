<?php

namespace app\controllers;

use app\components\Config;
use app\components\Telegram;
use app\controllers\pages\SubCategory;
use app\controllers\pages\SelectMenu;
use app\models\SubCategory as SubCategoryModel;
use app\models\Users;
use app\models\Words;
use app\controllers\pages\Home;
use app\controllers\pages\Category;
use yii\web\Controller;
use Yii;

class UsersController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * User pagelarini chaqiradi
     *
     * @param Telegram $telegram
     * @param array $user
     * @return bool
     */
    public static function hiUser(Telegram $telegram, array $user)
    {
        // update page 
        if ($telegram->text == '/start') {
            $home = new Home();
            $text = Yii::t('app/telegram', 'Welcome');
            return $home->run([
                'text' => $text
            ]);
        }

        switch ($user['page']) {
            case Config::PAGE_HOME:
                $home = new Home();
                return $home->run();
            case Config::PAGE_CATEGORY:
                $category = new Category();
                return $category->run();
            case Config::PAGE_SUB_CATEGORY:
                $sub_category = new SubCategory();
                return $sub_category->run();
            case Config::PAGE_SELECT_MENU:
                $select_menu = new SelectMenu();
                return $select_menu->run();
            case Config::PAGE_WORDS:
                return self::pageWords($telegram, $user);
        }
    }

    /**
     * Sub category page
     *
     * @param Telegram $telegram
     * @param array $user
     * @param integer $category_id
     * @return void
     */
    public static function pageSubCategory(Telegram $telegram, array $user)
    {
        // if ($telegram->text === Config::BACK) {
        //     $telegram->text = 'Boshlash';
        //     return self::pageHome($telegram, $user);
        // }

        $sub_category_id = SubCategoryModel::getId($telegram->text);

        if ($sub_category_id === null) {
            return $telegram->send('Iltimos unit tanlash uchun tugmalardan birini tanlang!');
        }

        $words = Words::get($sub_category_id);

        if (empty($words)) {
            return $telegram->send('Ushbu unitda lug`at mavjud emas');
        }

        if (self::beforePageWords($words, $user)) {
            Users::updatePage(Config::PAGE_WORDS, $user['id']);

            return self::pageWords($telegram, $user);
        }
    }

    public static function beforePageWords(array $words, array $user)
    {
        $array = [];
        $insert_array = [];

        foreach ($words as $word) {
            $array['words_id'] = $word['id'];
            $array['user_id'] = $user['id'];
            $array['all_attemp'] = 0;
            $array['last_attemp'] = 0;
            $array['correct'] = 0;
            $array['incorrect'] = 0;
            $insert_array[] = $array;
        }

        $result = Yii::$app->db->createCommand()
            ->batchInsert(
                'test',
                ['words_id', 'user_id', 'all_attemp', 'last_attemp', 'correct', 'incorrect'],
                $insert_array
            )->execute();

        return $result > 0;
    }
}