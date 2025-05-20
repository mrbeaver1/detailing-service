<?php

use yii\db\Migration;

class m250518_192807_fill_order_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->batchInsert('{{%order_status}}',
            ['id', 'name', 'created_at', 'updated_at'],
            [
                [1, 'Новая', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
                [2, 'В обработке', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
                [3, 'Подтверждена', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
                [4, 'Услуга оказана', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%order_status}}', ['id' => [1, 2, 3, 4]]);
    }
}
