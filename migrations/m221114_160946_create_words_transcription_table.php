<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%words_transcription}}`.
 */
class m221114_160946_create_words_transcription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%words_transcription}}', [
            'id' => $this->primaryKey(),
            'words_id' => $this->integer(),
            'title' => $this->string(),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
            'updated_date' => $this->timestamp(),
        ]);

        $this->addForeignKey('words_transcription-fk-words', 'words_transcription', 'words_id', 'words', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%words_transcription}}');
    }
}
