<?php

use yii\db\Migration;

class m170119_065351_alter_news_subscribers_table extends Migration
{
    public function up()
    {
        $this->dropColumn('news_subcribers', 'status');
    }

    public function down()
    {
        echo "m170119_065351_alter_news_subscribers_table cannot be reverted.\n";

        return false;
    }
}
