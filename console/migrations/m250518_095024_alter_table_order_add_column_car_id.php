<?php

use yii\db\Migration;

class m250518_095024_alter_table_order_add_column_car_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addColumn('{{%order}}', 'car_id', $this->integer());

        $this->addForeignKey('order_car_id_car_id_fk', '{{%order}}', 'car_id', '{{%car}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('order_car_id_car_id_fk', '{{%order}}');
        $this->dropColumn('{{%order}}', 'car_id');
    }
}
