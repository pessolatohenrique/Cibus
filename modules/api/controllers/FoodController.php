<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\models\Alimento;
use app\models\AlimentoSearch;

class FoodController extends ActiveController
{
    public $modelClass = 'app\models\Alimento';

    public function extraFields()
    {
        return ['grupo'];
    }

    // public function behaviors()
    // {
    //     $behaviors = parent::behaviors();
    //     $behaviors['authenticator'] = [
    //         'class' => HttpBearerAuth::className(),
    //     ];
    //     return $behaviors;
    // }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    // public function extraFields() {
    //     return ['alimento', 'refeicao'];
    // }

    public function actionIndex() {
        $searchModel = new AlimentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }
}