<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%words_sample}}`.
 */
class m221113_084820_create_words_sample_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%words_sample}}', [
            'id' => $this->primaryKey(),
            'words_id' => $this->integer(),
            'description_uz' => $this->text(),
            'description_ru' => $this->text(),
            'description_eng' => $this->text(),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
            'updated_date' => $this->timestamp(),
        ]);

        $this->addForeignKey('words_sample-fk-words', 'words_sample', 'words_id', 'words', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%words_sample}}');
    }
}
