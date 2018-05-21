<?php

namespace app\models;

use yii\base\Model;
use yii\db\Exception;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

    public $password;
    private $_user;

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6]
        ];
    }

    public function attributeLabels()
    {
        return [
        'password' => 'Введите новы пароль'
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */

    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save();
    }

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\db\Exception if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {

        if (empty($token) || !is_string($token)) {
            throw new Exception('Password reset token cannot be blank.');
        }

        $this->_user = User::findByPasswordResetToken($token);

        if (!$this->_user) {
            throw new Exception('Wrong password reset token.');
        }

        parent::__construct($config);
    }

}