<?php

use yii\db\Migration;

class m250512_175829_alter_table_users_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addColumn('{{%user}}', 'name', $this->string());
        $this->addColumn('{{%user}}', 'surname', $this->string());
        $this->addColumn('{{%user}}', 'patronymic', $this->string());
        $this->addColumn('{{%user}}', 'birthday', $this->dateTime());
        $this->addColumn('{{%user}}', 'avatar', $this->string());
        $this->addColumn('{{%user}}', 'role', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'name');
        $this->dropColumn('{{%user}}', 'surname');
        $this->dropColumn('{{%user}}', 'patronymic');
        $this->dropColumn('{{%user}}', 'birthday');
        $this->dropColumn('{{%user}}', 'avatar');
        $this->dropColumn('{{%user}}', 'role');
    }
}
