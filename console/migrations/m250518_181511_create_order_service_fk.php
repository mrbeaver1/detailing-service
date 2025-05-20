<?php

use yii\db\Migration;

class m250518_181511_create_order_service_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addForeignKey(
            'order_service_fk',
            '{{%order}}',
            'service_id',
            '{{%service}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey('order_service_fk', '{{%order}}');
    }
}
