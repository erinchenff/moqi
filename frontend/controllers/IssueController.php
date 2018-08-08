<?php

namespace frontend\controllers;

use Lhjx\Phabot\Conduit\Client;
use yii\web\Controller;

class IssueController extends Controller
{
    public function actionList()
    {
        $client = new Client('https://dx.wangcaigu.cn/', '');
        $issues = $client->request('maniphest.search', [
            'limit' => 10,
        ]);

        //var_dump($issues['data'][0]);

        return $this->render('list.twig', [
            'issues' => $issues['data'],
        ]);
    }
}
