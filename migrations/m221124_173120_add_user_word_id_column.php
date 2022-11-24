<?php

use yii\db\Migration;

/**
 * Class m221124_173120_add_user_word_id_column
 */
class m221124_173120_add_user_word_id_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'sub_category_id', $this->integer());
        $this->addForeignKey('users_fk_sub_category', 'users', 'sub_category_id', 'sub_category', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('users_fk_sub_category', 'users');
        $this->dropColumn('users', 'sub_category_id');
    }

/*
// Use up()/down() to run migration code without a transaction.
public function up()
{
}
public function down()
{
echo "m221124_173120_add_user_word_id_column cannot be reverted.\n";
return false;
}
*/
}