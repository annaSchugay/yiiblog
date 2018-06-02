<?php

namespace app\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use zabachok\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $created_by
 * @property int $created_at
 * @property int $status
 * @property int $category_id
 * @property string $thumbnail_base_url
 *  @property string $thumbnail_path
 * @property Category $category
 */
class Article extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;
    const PER_PAGE = 5;
    public $image;
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title'
            ],
            TimestampBehavior::className(),
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status', 'category_id'], 'required'],
            [['description'], 'string'],
            [['created_by', 'created_at', 'status', 'category_id'], 'integer'],
            [['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['thumbnail'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['title'], 'string', 'max' => 100],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'status' => 'Status',
            'thumbnail' => 'Thumbnail',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Опубликовано',
            self::STATUS_DELETE => 'Удалено'
        ];
    }
    public function getThumbnailUrl() {
        return $this->thumbnail_base_url . '/' . $this->thumbnail_path;
    }
}
