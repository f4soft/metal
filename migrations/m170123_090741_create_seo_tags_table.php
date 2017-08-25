<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seo_tags`.
 */
class m170123_090741_create_seo_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('seo_tags', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),
            'title' => $this->string(255),
            'description' => $this->string(255)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('seo_tags');
    }
}
