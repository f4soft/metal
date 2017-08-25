<?php

use yii\db\Migration;

/**
 * Handles the creation for table `sales`.
 */
class m161006_094334_create_sales_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%sales}}', [
            'id' => $this->primaryKey(),

            'image' => $this->string(),
            'image_alt_ru'=> $this->string(),
            'image_alt_ua'=> $this->string(),
            'image_alt_en'=> $this->string(),
            'image_title_ru'=> $this->string(),
            'image_title_ua'=> $this->string(),
            'image_title_en'=> $this->string(),

            'status' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sales');
    }
}
