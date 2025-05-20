<?php

use yii\db\Migration;

class m250518_095723_alter_table_user_add_column_promo_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addColumn('{{%user}}', 'promo_id', $this->integer());

        $this->addForeignKey(
            'fk_user_promo_id_promo_id_fk',
            '{{%user}}',
            'promo_id',
            '{{%promo}}',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
       $this->dropForeignKey('fk_user_promo_id_promo_id_fk', '{{%user}}');
       $this->dropColumn('{{%user}}', 'promo_id');
    }
}
