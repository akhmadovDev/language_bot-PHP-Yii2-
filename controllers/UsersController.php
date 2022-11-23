<?php

namespace app\controllers;

use app\components\Config;
use app\components\Keyboard;
use app\components\Telegram;
use app\models\SubCategory;
use app\models\Category;
use app\models\Users;
use app\models\Words;
use Telegram\Bot\Objects\Message as MessageObject;
use app\controllers\pages\Home;
use Yii;
use Exception;

class UsersController extends \yii\web\Controller
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
                return self::pageCategory($telegram, $user);
            case Config::PAGE_SUB_CATEGORY:
                return self::pageSubCategory($telegram, $user);
            case Config::PAGE_WORDS:
                return self::pageWords($telegram, $user);
        }
    }

    /**
     * Category page
     *
     * @param Telegram $telegram
     * @param array $user
     * @return void
     */
    public static function pageCategory(Telegram $telegram, array $user)
    {
        if ($telegram->text == Config::BACK) {
            $text = Yii::t('app/telegram', 'Welcome');
            $home = new Home();
            return $home->run([
                'text' => $text
            ]);
        }

        $category_id = Category::getId($telegram->text);

        if ($category_id == false) {
            return $telegram->send('Kategoriya mavjud emas iltimos tugmalardan birini tanlang');
            exit;
        }

        // Sub Category page
        $sub_category = SubCategory::getAll($category_id);

        if ($sub_category === null) {
            return $telegram->send('Ushbu kategoriyaga tegishli ma`lumot mavjud emas');
        }

        // Sub kategoriyalarni qaytaradi
        Users::updatePage(Config::PAGE_SUB_CATEGORY, $user['id']);
        return $telegram->send('Sub kategoriyalardan birini tanlang', $sub_category);
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
        if ($telegram->text === Config::BACK) {
            $telegram->text = 'Boshlash';
            return self::pageHome($telegram, $user);
        }

        $sub_category_id = SubCategory::getId($telegram->text);

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

    public static function pageWords(Telegram $telegram, array $user)
    {
        if ($telegram->text === Config::BACK) {
            return self::pageHome($telegram, $user);
        }
    }
}