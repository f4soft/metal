<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages_images`.
 */
class m170130_092905_create_pages_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages_images', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'description' => $this->string(),
            'circle_image' => $this->string(),
            'bg_image' => $this->string(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pages_images');
    }
}
