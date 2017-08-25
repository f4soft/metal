<?php

use yii\db\Migration;

class m170330_075647_alter_block_settings_table extends Migration
{
    public function up()
    {
        $this->addColumn('block_settings', 'presscenter_price_ru', $this->string());
        $this->addColumn('block_settings', 'presscenter_price_ua', $this->string());
        $this->addColumn('block_settings', 'presscenter_price_en', $this->string());

        $this->addColumn('block_settings', 'presscenter_price_image_ru', $this->text());
        $this->addColumn('block_settings', 'presscenter_price_image_ua', $this->text());
        $this->addColumn('block_settings', 'presscenter_price_image_en', $this->text());
    }

    public function down()
    {
        echo "m170330_075647_alter_block_settings_table reverted.\n";

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
