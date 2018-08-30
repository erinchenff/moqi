<?php

namespace common\models;

use Yii;
use yii\base\Model;

class LoginAuth extends Model
{
    public $loginName;
    public $password;

    public function rules()
    {
        return [
            [['loginName', 'password'], 'required'],
        ];
    }

    public function check()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = User::findOneActiveByLoginName($this->loginName);
        if (null === $user) {
            $this->addError('loginName', '用户名或密码错误');

            return false;
        }

        if (!$user->validatePassword($this->password)) {
            $this->addError('loginName', '用户名或密码错误');

            return false;
        }

        return Yii::$app->user->login($user);
    }
}
