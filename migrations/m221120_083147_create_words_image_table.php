<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%words_image}}`.
 */
class m221120_083147_create_words_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%words_image}}', [
            'id' => $this->primaryKey(),
            'words_id' => $this->integer(),
            'image' => $this->string(),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
            'updated_date' => $this->timestamp()
        ]);

        $this->addForeignKey('words_image-fk-words', 'words_image', 'words_id', 'words', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%words_image}}');
    }
}
