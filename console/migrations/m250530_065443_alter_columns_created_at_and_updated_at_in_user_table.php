<?php

use yii\db\Migration;

class m250530_065443_alter_columns_created_at_and_updated_at_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'created_at');
        $this->dropColumn('user', 'updated_at');

        $this->addColumn('user', 'created_at', $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->addColumn('user', 'updated_at', $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'created_at');
        $this->dropColumn('user', 'updated_at');
        $this->addColumn('user', 'created_at', $this->integer()->notNull());
        $this->addColumn('user', 'updated_at', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250530_065443_alter_columns_created_at_and_updated_at_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
