<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class User extends BaseActiveRecord implements IdentityInterface
{
    /**
     * @return User
     */
    public static function initNew($realName, $password)
    {
        $user = new User();
        $user->realName = $realName;
        $user->setPassword($password);

        return $user;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'isDisabled' => false]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    /**
     * 根据登录名找到未禁用的用户
     *
     * @return User
     */
    public static function findOneActiveByLoginName($loginName)
    {
        $user = null;

        $login = Login::findOne(['name' => $loginName]);
        if (null !== $login) {
            $user = User::findOne([
                'id' => $login->userId,
                'isDisabled' => false,
            ]);
        }

        return $user;
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }
}
