<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%words_audio}}`.
 */
class m221113_084828_create_words_audio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%words_audio}}', [
            'id' => $this->primaryKey(),
            'words_id' => $this->integer(),
            'audio' => $this->string(),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
            'updated_date' => $this->timestamp()
        ]);

        $this->addForeignKey('words_audio-fk-words', 'words_audio', 'words_id', 'words', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%words_audio}}');
    }
}
