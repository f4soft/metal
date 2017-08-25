<?php

use yii\db\Migration;

class m161211_095526_alter_block_settings_table extends Migration
{
    public function up()
    {
        $this->addColumn('block_settings', 'sales_image', $this->string());

        $this->addColumn('block_settings', 'sales_image_alt_ru', $this->string());
        $this->addColumn('block_settings', 'sales_image_alt_ua', $this->string());
        $this->addColumn('block_settings', 'sales_image_alt_en', $this->string());

        $this->addColumn('block_settings', 'sales_image_title_ru', $this->string());
        $this->addColumn('block_settings', 'sales_image_title_ua', $this->string());
        $this->addColumn('block_settings', 'sales_image_title_en', $this->string());
    }

    public function down()
    {
        echo "m161211_095526_alter_block_settings_table cannot be reverted.\n";

        return false;
    }
}
