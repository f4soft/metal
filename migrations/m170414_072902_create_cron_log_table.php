<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cron_log`.
 */
class m170414_072902_create_cron_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cron_log', [
            'id' => $this->primaryKey(),
            'last_date_run' => $this->integer(11)->notNull()
        ]);

        $this->dropColumn('news_subcribers', 'last_send_date');
        $this->dropColumn('news', 'sent');
        $this->dropColumn('sales', 'sent');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cron_log');
    }
}
