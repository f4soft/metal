<?php

use yii\db\Migration;

class m170403_065827_alter_block_settings_add_cart_banner extends Migration
{
    public function up()
    {
        $this->addColumn('block_settings', 'cart_banner_ru', $this->string()->defaultValue(''));
        $this->addColumn('block_settings', 'cart_banner_ua', $this->string()->defaultValue(''));
        $this->addColumn('block_settings', 'cart_banner_en', $this->string()->defaultValue(''));
        $this->addColumn('block_settings', 'services_banner_ru', $this->string()->defaultValue(''));
        $this->addColumn('block_settings', 'services_banner_ua', $this->string()->defaultValue(''));
        $this->addColumn('block_settings', 'services_banner_en', $this->string()->defaultValue(''));
    }

    public function down()
    {
        echo "m170403_065827_alter_block_settings_add_cart_banner reverted.\n";

        return true;
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
