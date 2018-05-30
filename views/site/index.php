<?php

/* @var $this yii\web\View
 * @var $articleDataProvider yii\data\ActiveDataProvider
 * @var $categoryDataProvider yii\data\ActiveDataProvider
 */


use yii\widgets\ListView;

$this->title = 'IT blog';

?>
<body class="<?= $this->context = "home-page"; ?>">
<div class="col-sm-8 col-md-8 col-lg-8">
    <?php echo ListView::widget([
        'dataProvider' => $articleDataProvider,
        'itemView' => '_list-articles',
        'emptyText' => 'В блоге пока нет статей',
        'emptyTextOptions' => [
            'tag' => 'p',
            'class' => 'no-articles-notification'
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'article-item',
        ],
        'sorter' => [
            'attributes'=>['id','name'],
            'sort'=>'ASC',
        ],
        'layout' => "<div class='list-articles'>{items}</div>\n{pager}",
        'pager' => [
            'maxButtonCount' => 5,
        ]
    ]);
    ?>
</div>
<div class="col-sm-4 col-md-4 col-lg-4">
    <?php echo ListView::widget([
        'dataProvider' => $categoryDataProvider,
        'itemView' => '_list-categories',
        'options' => [
            'tag' => 'ul',
            'class' => 'categories-list',
        ],
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'category-title',
        ],
        'layout' => "{items}",
        'summary' => false
    ]);
    ?>
</div>