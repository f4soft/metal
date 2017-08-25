<?php

use yii\db\Migration;

/**
 * Handles the creation for table `polls`.
 */
class m161006_114914_create_polls_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%polls}}', [
            'id' => $this->primaryKey(),

            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'total_votes' => $this->integer(),
            'is_multiple' => $this->boolean(),
            'status' => $this->boolean(),
            'alias' => $this->string(),

            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('polls');
    }
}
