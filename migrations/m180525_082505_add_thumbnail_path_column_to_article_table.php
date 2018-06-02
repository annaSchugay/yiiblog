<?php

use yii\db\Migration;

/**
 * Handles adding thumbnail_path to table `article`.
 */
class m180525_082505_add_thumbnail_path_column_to_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'thumbnail_path', $this->string(1024));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'thumbnail_path');
    }
}
