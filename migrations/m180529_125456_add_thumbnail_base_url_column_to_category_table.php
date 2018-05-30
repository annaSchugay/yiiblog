<?php

use yii\db\Migration;

/**
 * Handles adding thumbnail_base_url to table `category`.
 */
class m180529_125456_add_thumbnail_base_url_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'thumbnail_base_url', $this->string(1024));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'thumbnail_base_url');
    }
}
