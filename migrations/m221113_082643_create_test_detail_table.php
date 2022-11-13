<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_detail}}`.
 */
class m221113_082643_create_test_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_detail}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(),
            'attemp' => $this->integer(),
            'created_date' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_detail}}');
    }
}
