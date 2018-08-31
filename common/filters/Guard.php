<?php

namespace common\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class Guard extends ActionFilter
{
    public $except = [
        'site/index',
        'auth/*',
        'debug/*', // 允许未登录时显示调试工具条
    ];

    public function beforeAction($action)
    {
        $isGuest = Yii::$app->user->getIsGuest();
        if (!$isGuest) {
            return true;
        }

        throw new ForbiddenHttpException();
    }
}
