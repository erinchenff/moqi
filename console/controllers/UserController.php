<?php

namespace console\controllers;

use App\Model\Login;
use App\Model\LoginType;
use App\Model\User;

class UserController extends BaseController
{
    public function actionCreate($mobile, $realName, $password)
    {
        $db = User::getDb();

        $trx = $db->beginTransaction();
        try {
            $user = User::initNew($realName, $password);
            $user->save();

            $login = Login::initNew($user, $mobile, LoginType::MOBILE);
            $login->save();

            $trx->commit();
        } catch (\Throwable $ex) {
            $trx->rollBack();
            throw $ex;
        }
    }
}
