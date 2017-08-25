<?php

use yii\db\Migration;

class m170407_073506_alter_news_sales_tables extends Migration
{
    public function up()
    {
        $this->addColumn('sales', 'sent', $this->boolean()->defaultValue(0));
        $this->addColumn('news', 'sent', $this->boolean()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('sales', 'sent');
        $this->dropColumn('news', 'sent');
        echo "m170407_073506_alter_news_sales_tables reverted.\n";

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
