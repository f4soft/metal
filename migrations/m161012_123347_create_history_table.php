<?php

use yii\db\Migration;

/**
 * Handles the creation for table `history`.
 */
class m161012_123347_create_history_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey(),

            'title' => $this->string()->notNull(),

            'description_ru' => $this->string(270),
            'description_ua' => $this->string(270),
            'description_en' => $this->string(270),

            'image' => $this->string(),
            'image_alt_ru' => $this->string(),
            'image_alt_ua' => $this->string(),
            'image_alt_en' => $this->string(),
            'image_title_ru' => $this->string(),
            'image_title_ua' => $this->string(),
            'image_title_en' => $this->string(),

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
        $this->dropTable('history');
    }
}
