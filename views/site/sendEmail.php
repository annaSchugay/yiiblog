<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SendEmailResetPasswordForm */
/* @var $form ActiveForm */

$this->title = 'Send email';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-send-email">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out your email. A link to reset password will be sent there.</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'send-email']); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>