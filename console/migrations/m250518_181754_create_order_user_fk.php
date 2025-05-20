<?php

use yii\db\Migration;

class m250518_181754_create_order_user_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addForeignKey(
            'order_user_fk',
            '{{%order}}',
            'client_id',
            '{{%user}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey('order_user_fk', '{{%order}}');
    }
}
