<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignUpForm extends Model
{

    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function saveUser()
    {
        $user = new User();
        $user->username = $this->username;
        $user->generateAuthKey();
        $user->setPassword($this->password);
        $user->email = $this->email;
        $user->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        $user->status = User::STATUS_WAITING;
        $user->save();
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        return $user;

    }
}