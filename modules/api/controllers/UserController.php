<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\models\LoginForm;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\LoginForm';

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return ['access_token' => Yii::$app->user->identity->generateToken()];
        } else {
            $model->validate();
            return $model;
        }
    }
}