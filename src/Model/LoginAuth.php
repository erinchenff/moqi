<?php

namespace App\Model;

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

        $login = Login::findOne(['name' => $this->loginName]);
        if (null === $login) {
            $this->addError('loginName', '用户名或密码错误');

            return false;
        }

        $user = User::findOne([
            'id' => $login->userId,
            'isDisabled' => false,
        ]);
        if (null === $login) {
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