<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news_subcribers`.
 */
class m161107_140035_create_news_subcribers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news_subcribers', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'hash' => $this->string()->defaultValue(NULL),
            'language' => $this->string(),

            'status' => $this->boolean()->defaultValue(0),
            'confirmed_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
            'last_send_date' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news_subcribers');
    }
}
