<?php

namespace frontend\controllers;

class IssueController extends BaseController
{
    public function actionList()
    {
        $client = $this->get('conduitClient');

        $issues = $client->request('maniphest.search', [
            'limit' => 10,
        ]);

        return $this->render('list.twig', [
            'issues' => $issues['data'],
        ]);
    }
}
