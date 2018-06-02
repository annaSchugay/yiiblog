<?php

use yii\helpers\Html;

echo Html::tag('span', Html::encode($model->title), ['class' => 'category-title']);
echo Html::tag('span', Html::encode($model->getArticles()->count()), ['class' => 'articles-count']);