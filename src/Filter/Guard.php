<?php

namespace App\Filter;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class Guard extends ActionFilter
{
    public $except = [
        'site/index',
        'auth/*',
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