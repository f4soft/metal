<?php

use yii\db\Migration;

/**
 * Handles the creation for table `reports`.
 */
class m161013_081123_create_reports_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('reports', [
            'id' => $this->primaryKey(),

            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'file' => $this->string()->notNull(),

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
        $this->dropTable('reports');
    }
}
