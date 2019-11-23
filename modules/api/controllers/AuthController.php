<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\models\LoginForm;
use app\models\User;

class AuthController extends ActiveController
{
    public $modelClass = 'app\models\LoginForm';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        
        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }
    
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            $token = Yii::$app->user->identity->generateToken();
            $user = User::find()->where(['username' => $model->username])->one();
            $user->access_token = $token;
            $user->save(false);

            return ['access_token' => $token];
        } else {
            $model->validate();
            return $model;
        }
    }
}