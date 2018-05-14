<?php

namespace app\models;

use Yii;
use zabachok\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $created_by
 * @property int $created_at
 *
 * @property Article[] $articles
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
            TimestampBehavior::className()
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status'], 'required'],
            [['description'], 'string'],
            [['status', 'created_by', 'created_at'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Опубликовано',
            self::STATUS_DELETE => 'Удалено'
        ];
    }
}
