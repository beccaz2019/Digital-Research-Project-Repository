<?php

namespace app\controllers;

class DeveloperController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
