<?php

use yii\db\Migration;

/**
 * Class m180530_142328_tags
 */
class m180530_142328_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)
        ]);

        $this->insert('tag', [
            'name' => 'tag 1',
        ]);

        $this->createTable('article_tag', [
            'article_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx_article_tag_tag_id',
            'article_tag',
            'tag_id'
        );

        $this->createIndex(
            'idx_article_tag_article_id',
            'article_tag',
            'article_id'
        );

        $this->addForeignKey(
            'fk_article_article_tag',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_article_tag_tag',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_article_article_tag',
            'article'
        );

        $this->dropForeignKey(
            'fk_article_tag_tag',
            'article_tag'
        );

        $this->dropTable('tag');
        $this->dropTable('article_tag');
    }
}
