<?php

use yii\db\Migration;

/**
 * Handles the creation for table `cities`.
 */
class m161005_095047_create_cities_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),

            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),
            'external_id' => $this->string(),

            'status' => $this->boolean(),
            'alias' => $this->string(),
            'is_default' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cities');
    }
}
