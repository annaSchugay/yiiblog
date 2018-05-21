<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180512_084219_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'slug' => $this->string(255),
            'category_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->insert('article', [
            'title' => 'Article 1',
            'description' => 'Description Article 1',
            'slug' => 'article_1',
            'status' => 2,
            'created_by' => 101,
            'updated_by' => 101,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->createIndex(
            'idx-article-category_id',
            'article',
            'category_id'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');
    }
}
