<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\models\GrupoAlimentar;
use app\models\GrupoAlimentarSearch;

class FoodGroupController extends ActiveController
{
    public $modelClass = 'app\models\GrupoAlimentar';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex() {
        $searchModel = new GrupoAlimentarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }
}