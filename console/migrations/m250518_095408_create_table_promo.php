<?php

use yii\db\Migration;

class m250518_095408_create_table_promo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%promo}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'discount' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%promo}}');
    }
}
