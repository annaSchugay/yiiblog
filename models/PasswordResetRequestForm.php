<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\conditions\NotCondition;
use yii\db\Exception;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    public function sendEmail()
    {
        $user = $this->getCurrentUser();
        $this->updateToken($user);

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

    private function getCurrentUser()
    {
        try {
            return User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function updateToken($user) {
        /* @var  $user \app\models\User */
        $user->generatePasswordResetToken();
        try {
            $user->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}