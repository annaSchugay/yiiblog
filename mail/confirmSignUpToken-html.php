<?php

/* @var $user app\models\SignUpForm
 * @var $password_reset_token app\models\User*/

use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/index', 'token' => $user->password_reset_token]);
?>

<div class="confirm-signup">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Follow the link below to to confirm your account:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>