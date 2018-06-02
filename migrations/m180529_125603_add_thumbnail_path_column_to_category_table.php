<?php

use yii\db\Migration;

/**
 * Handles adding thumbnail_path to table `category`.
 */
class m180529_125603_add_thumbnail_path_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'thumbnail_path', $this->string(1024));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'thumbnail_path');
    }
}
