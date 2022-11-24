<?php

use yii\db\Migration;

/**
 * Class m221124_182321_add_user_columns
 */
class m221124_182321_add_user_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'category_id', $this->integer());
        $this->addForeignKey('users_fk_category', 'users', 'category_id', 'category', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('users_fk_category', 'users');
        $this->dropColumn('users', 'category_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221124_182321_add_user_columns cannot be reverted.\n";

        return false;
    }
    */
}
