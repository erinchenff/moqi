<?php

namespace frontend\controllers;

use App\Model\LoginAuth;
use Yii;

class AuthController extends BaseController
{
    public function actionLogin()
    {
        $auth = new LoginAuth();

        return $this->render('login.twig', [
            'model' => $auth,
            'error' => $this->getFlash('authError'),
        ]);
    }

    public function actionCheck()
    {
        $data = Yii::$app->request->post();

        $auth = new LoginAuth();
        if ($auth->load($data) && $auth->check()) {
            return $this->goHome();
        }

        $error = '未知错误';
        if ($auth->hasErrors()) {
            $errors = $auth->getFirstErrors();
            $error = reset($errors);
        }

        $this->setFlash('authError', $error);

        return $this->redirect('/auth/login?failed');
    }

    public function actionMe()
    {
        $me = [
            'isGuest' => true,
        ];

        $user = $this->getAuthedUser();
        if (null !== $user) {
            $me['isGuest'] = false;
            $me['info'] = $user->getAttributes([
                'realName',
            ]);
        }

        return $this->json($me);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
