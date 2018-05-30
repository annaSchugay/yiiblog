<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<?= Html::img( \yii\helpers\Url::to($model->thumbnailUrl), ['alt' => 'My logo']) ?>
<h3><?= Html::encode($model->title) ?></h3>
<p><?= \yii\helpers\StringHelper::truncate(Html::encode($model->description),150,'...'); ?></p>
<a class="button" href="<?= Yii::$app->urlManager->createUrl(['article/view', 'slug' => $model->slug]) ?>">Читать далее</a>
