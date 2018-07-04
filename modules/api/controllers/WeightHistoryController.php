<?php

namespace app\modules\api\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\components\FormatterHelper;
use app\models\HistoricoPeso;
use app\models\HistoricoPesoSearch;

class WeightHistoryController extends ActiveController
{
    public $modelClass = 'app\models\HistoricoPeso';

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
        $searchModel = new HistoricoPesoSearch();
        $result = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $result
        ]);

        $final_array = [];

        foreach($result as $key => $val) {
            $final_result = array(
                "id" => $val->id,
                "usuario_id" => $val->usuario_id,
                "data_lancamento" => $val->data_lancamento,
                "peso" => FormatterHelper::formatBrazilian($val->peso),
                "diferenca_peso" => FormatterHelper::formatBrazilian($val->diferenca),
                "diferenca_imc" => FormatterHelper::formatBrazilian($val->diferenca_imc),
                "classificacao_imc" => $val->usuario->classificacao_imc
            );

            array_push($final_array, $final_result);
        }

        return $final_array;
    }
}



/*       
        "id": 35,
        "usuario_id": 9,
        "data_lancamento": "01/07/2018",
        "peso": "63.00"
        ]);*/