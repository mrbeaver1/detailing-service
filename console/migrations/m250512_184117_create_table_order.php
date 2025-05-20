<?php

use yii\db\Migration;

class m250512_184117_create_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer(),
            'service_id' => $this->integer(),
            'status' => $this->integer(),
            'date' => $this->dateTime(),
            'personal_price' => $this->float(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
