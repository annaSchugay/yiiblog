<?php

use yii\db\Migration;

/**
 * Handles adding thumbnail_base_url to table `article`.
 */
class m180525_082408_add_thumbnail_base_url_column_to_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'thumbnail_base_url', $this->string(1024));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'thumbnail_base_url');
    }
}
