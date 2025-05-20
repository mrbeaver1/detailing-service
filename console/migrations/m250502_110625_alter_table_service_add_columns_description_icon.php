<?php

use yii\db\Migration;

class m250502_110625_alter_table_service_add_columns_description_icon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addColumn('{{%service}}', 'description', $this->text());
        $this->addColumn('{{%service}}', 'icon', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%service}}', 'description');
        $this->dropColumn('{{%service}}', 'icon');
    }
}
