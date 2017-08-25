<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news_token`.
 */
class m161108_084112_create_news_token_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news_token', [
            'id' => $this->primaryKey(),
            'news_subscriber_id' => $this->integer(),
            'code' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news_token');
    }
}
