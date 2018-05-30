<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="article-index">
    <?php if ( isset( $this->breadcrumbs ) ): ?>
        <nav class="bread-crumbs">
            <?php
            $this->widget('zii.widgets.CBreadcrumbs',
                array(
                    'links'			=>$this->breadcrumbs,
                    'tagName'		=>'ul', // container tag
                    'htmlOptions'	=>array(), // no attributes on container
                    'separator'		=>'', // no separator
                    'homeLink'		=>'<li><a href="/">Главная</a></li>', // home link template
                    'activeLinkTemplate'	=>'<li><a href="{url}">{label}</a></li>', // active link template
                    'inactiveLinkTemplate'	=>'<li class="selected"><a>{label}</a></li>', // in-active link template
                ));
            ?><!-- breadcrumbs -->
        </nav>
    <?php endif ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'thumbnailUrl',
                'value'=>$model->thumbnailUrl,
                'format' => ['image',['width'=>'100']],
            ],
            'id',
            'title',
            'description:ntext',
            'created_by',
            'created_at:relativeTime',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->status
                        ? '<span class="text-success">Опубликовано</span>'
                        : '<span class="text-danger">Удалено</span>';
                }
            ],
            'category_id',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'view/?slug=' . $model->slug);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'update/?slug=' . $model->slug);
                    }
                ]
            ]
        ]
    ]); ?>
</div>
