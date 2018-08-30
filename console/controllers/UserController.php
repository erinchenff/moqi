<?php

namespace console\controllers;

use common\models\Login;
use common\models\LoginType;
use common\models\User;

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
