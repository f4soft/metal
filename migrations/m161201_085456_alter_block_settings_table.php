<?php

use yii\db\Migration;

class m161201_085456_alter_block_settings_table extends Migration
{
    public function up()
    {
        $table = 'block_settings';

        $this->addColumn($table, 'catalog_page_seo_title_ru', $this->string());
        $this->addColumn($table, 'catalog_page_seo_title_ua', $this->string());
        $this->addColumn($table, 'catalog_page_seo_title_en', $this->string());

        $this->addColumn($table, 'catalog_page_seo_description_ru', $this->text());
        $this->addColumn($table, 'catalog_page_seo_description_ua', $this->text());
        $this->addColumn($table, 'catalog_page_seo_description_en', $this->text());
    }

    public function down()
    {
        echo "m161201_085456_alter_block_settings_table cannot be reverted.\n";

        return false;
    }
}
