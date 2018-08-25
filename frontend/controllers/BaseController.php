<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public function get($id)
    {
        return Yii::$container->get($id);
    }

    public function setFlash($key, $value)
    {
        Yii::$app->session->setFlash($key, $value);
    }

    public function getFlash($key)
    {
        return Yii::$app->session->getFlash($key);
    }

    /**
     * @return \App\Model\User
     */
    public function getAuthedUser()
    {
        return Yii::$app->user->getIdentity();
    }

    public function json($data)
    {
        Yii::$app->response->format = 'json';

        return $data;
    }
}
