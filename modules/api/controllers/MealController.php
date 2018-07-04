<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;

use app\models\UsuarioRefeicao;
use app\models\UsuarioRefeicaoSearch;
use app\models\Alimento;

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

    public function actionIndex() {
        $searchModel = new UsuarioRefeicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }

    /**
     * calcula o total de calorias de um alimento, de acordo com a quantidade informada
     * @param Integer $id id do alimento pesquisado
     * @param Integer $quantidade quantidade consumida
     * @return void
     */
    public function actionCalculate($id, $quantidade)
    {
        $alimento = Alimento::find()->where(['id' => $id])->one();
        $final_array = array('calorias' => 0);

        if (!empty($alimento)) {
            $alimento->calculaCalorias($quantidade);
            $final_array = array(
                'medida_caseira' => $alimento->medida_caseira,
                'calorias' => $alimento->total_calorias
            );
        }

        return $final_array;
    }

    public function actionCalculateCalories() {
        $searchModel = new UsuarioRefeicaoSearch();
        // $model = new UsuarioRefeicao();
        $dataProvider = $searchModel->searchSumGroup(Yii::$app->request->queryParams);
        $result_models = $dataProvider->getModels();
        $final_array = array();

        if (!empty($result_models)) {
            foreach($result_models as $key => $val) {
                $tmp_array = array(
                    "refeicao_id" => $val->refeicao_id,
                    "refeicao_descricao" => $val->refeicao->descricao,
                    "horario_consumo" => $val->horario_consumo,
                    "calorias_total" => $val->calorias_total
                );

                array_push($final_array, $tmp_array);
            }
        }
        
        return $final_array;
    }

}