<?php

use yii\db\Migration;

class m250518_202220_fill_promo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->batchInsert('{{%promo}}', ['id', 'title', 'discount', 'created_at', 'updated_at'], [
            [1, 'base', 5, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            [2, 'medium', 10, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            [3, 'pro', 20, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->delete('{{%promo}}', ['id' => [1, 2, 3]]);
    }
}
