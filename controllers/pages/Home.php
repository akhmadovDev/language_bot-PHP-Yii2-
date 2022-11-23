<?php

namespace app\controllers\pages;

use app\components\Telegram;
use app\models\Category;
use app\components\Config;
use app\components\Keyboard;
use Yii;
use Exception;

class Home extends Telegram
{
   /**
    * xato kamanda berilmayotganligini tekshiradi
    * Asosan birinchi berilgan buyruqni tekshiradi
    * @return boolean
    */
   public function inCorrectCommand(): bool
   {
      return $this->text !== Yii::t('app/telegram', 'Begin');
   }

   /**
    * Kamnda rostligini tekshiradi
    * Asosan birinchi berilgan buyruqni tekshiradi
    * @return boolean
    */
   public function correctCommand(): bool
   {
      return $this->text === Yii::t('app/telegram', 'Begin');
   }

   /**
    * Kamnda rostligini tekshiradi
    * Asosan Ushbu sahifaga qaytishda ishlatiladi
    * @return boolean
    */
   public function welcomeCommand(): bool
   {
      return $this->text === Yii::t('app/telegram', 'Welcome');
   }

   /**
    * Kategoriyalarni olib chiqadi
    * agar ma'lumot mavjud bo'lmasa yangi exception yozadi
    * 
    * @return array
    */
   public function getCategories(): array
   {
      $categories = Category::getAll();

      if (empty($categories)) {
         throw new Exception('Hozirda kategoriyalar mavjud emas');
      }

      return $categories;
   }

   /**
    * Kategoriyalarni keyboard shakliga o'tkazadi
    *
    * @param array $categories
    * @return Keyboard
    */
   public function categoriesKeyboard(array $categories): Keyboard
   {
      return Keyboard::keyboard($categories);
   }

   /**
    * go to next page
    *
    * @return boolean
    */
   public function goToNextPage(): bool
   {
      $categories = $this->getCategories();
      $keyboards = $this->categoriesKeyboard($categories);

      if ($this->updatePage(Config::PAGE_CATEGORY)) {
         $this->send(Yii::t('app/telegram', 'Kategoriya tanlang'), $keyboards);

         return true;
      }

      return false;
   }

   /**
    * welcome home page
    *
    * @return boolean
    */
   public function welcomeHome(): bool
   {
      if ($this->updatePage(Config::PAGE_HOME)) {
         $this->send('salom bu home page', Keyboard::home());
         return true;
      }
      return false;
   }

   /**
    * Run Home page
    *
    * @param array $options
    * @return bool
    */
   public function run(array $options = [])
   {
      try {

         $this->afterRun($options);

         if ($this->correctCommand()) {
            return $this->goToNextPage();
         }

         if ($this->welcomeCommand()) {
            return $this->welcomeHome();
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
}