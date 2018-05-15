<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180512_084219_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'slug' => $this->string(255),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->insert('category', [
            'title' => 'Category 1',
            'description' => 'Description Category 1',
            'slug' => 'category_1',
            'status' => 1,
            'created_by' => 101,
            'updated_by' => 101,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->addForeignKey(
            'fk-article-category_id',
            'article',
            'category_id',
            'category',
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
            'fk-article-category_id',
            'article'
        );

        $this->dropTable('category');
    }
}
