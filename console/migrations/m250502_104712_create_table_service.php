<?php

use yii\db\Migration;

class m250502_104712_create_table_service extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%service}}');
    }
}
