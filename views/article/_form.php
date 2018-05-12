<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Article;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $this yii\web\ArrayHelper */
/* @var $model app\models\Article */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->dropDownList([100 => 'admin', 101 => 'user' ]); ?>

    <?= $form->field($model, 'status')->dropDownList(Article::getStatusList()) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(),'id', 'title'),
        ['prompt' => 'Выберите категорию']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
