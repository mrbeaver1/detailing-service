<?php

use yii\db\Migration;

class m250518_090544_create_table_order_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%order_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'order_status_order_status_id_fk',
            '{{%order}}',
            'status',
            '{{%order_status}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey('order_status_order_status_id-fk', '{{%order}}');

        $this->dropTable('{{%order_status}}');
    }
}
