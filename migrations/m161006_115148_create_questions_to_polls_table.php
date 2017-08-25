<?php

use yii\db\Migration;

/**
 * Handles the creation for table `questions_to_polls`.
 */
class m161006_115148_create_questions_to_polls_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%questions_to_polls}}', [
            'id' => $this->primaryKey(),
            'poll_id' => $this->integer()->notNull(),
            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'alias' => $this->string(),
            'votes_count' => $this->integer(),
            'status' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        $this->createIndex(
            'idx-questions_to_polls-poll_id',
            'questions_to_polls',
            'poll_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('questions_to_polls');
    }
}
