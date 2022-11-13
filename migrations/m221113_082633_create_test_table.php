<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test}}`.
 */
class m221113_082633_create_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test}}', [
            'id' => $this->primaryKey(),
            'words_id' => $this->integer(),
            'user_id' => $this->integer(),
            'all_attemp' => $this->bigInteger(),
            'last_attemp' => $this->integer(),
            'correct' => $this->integer(),
            'incorrect' => $this->integer()
        ]);

        $this->addForeignKey('test-fk-words', 'test', 'words_id', 'words', 'id');
        $this->addForeignKey('test-fk-user', 'test', 'user_id', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test}}');
    }
}
