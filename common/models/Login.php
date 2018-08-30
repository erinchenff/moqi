<?php

namespace common\models;

class Login extends BaseActiveRecord
{
    /**
     * @return Login
     */
    public static function initNew(User $user, $name, $type)
    {
        $login = new Login();
        $login->name = $name;
        $login->userId = $user->id;
        $login->type = $type;

        return $login;
    }
}
