<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%words}}`.
 */
class m221113_082622_create_words_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%words}}', [
            'id' => $this->primaryKey(),
            'sub_category_id' => $this->integer(),
            'title_uz' => $this->string(),
            'title_ru' => $this->string(),
            'title_eng' => $this->string(),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
            'updated_date' => $this->timestamp(),
        ]);

        $this->addForeignKey('words-fk-sub_category', 'words', 'sub_category_id', 'sub_category', 'id');
        $this->addForeignKey('users-fk-words', 'users', 'words_id', 'words', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%words}}');
    }
}
