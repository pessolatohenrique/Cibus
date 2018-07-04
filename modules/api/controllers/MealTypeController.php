<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

use app\models\Refeicao;
use app\models\RefeicaoSearch;

class MealTypeController extends ActiveController
{
    public $modelClass = 'app\models\Refeicao';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    
    public function actionIndex() {
        $searchModel = new RefeicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }
}