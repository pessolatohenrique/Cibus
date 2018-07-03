<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

use app\models\UsuarioRefeicao;
use app\models\UsuarioRefeicaoSearch;

class MealController extends ActiveController
{
    public $modelClass = 'app\models\UsuarioRefeicao';

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

    // public function extraFields() {
    //     return ['alimento', 'refeicao'];
    // }

    public function actionIndex() {
        $searchModel = new UsuarioRefeicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }
}