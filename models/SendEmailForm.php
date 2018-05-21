<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\conditions\NotCondition;
use yii\db\Exception;

/**
 * Password reset request form
 */
class SendEmailForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::className(),
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Введите Ваш email-адресс'
        ];
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

    private function updateToken($user)
    {
        /* @var  $user \app\models\User */
        $user->generatePasswordResetToken();
        try {
            $user->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function sendEmail()
    {
        $user = $this->getCurrentUser();
        $this->updateToken($user);
        return Yii::$app
            ->mailer
            ->compose('passwordResetToken-html', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}