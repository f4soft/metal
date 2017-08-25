<?php

use yii\db\Migration;

class m161117_062652_alter_block_settings_table extends Migration
{
    public function up()
    {
        $this->addColumn('block_settings', 'newsletter_enable', $this->boolean()->defaultValue(1));
    }

    public function down()
    {
        echo "m161117_062652_alter_block_settings_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
