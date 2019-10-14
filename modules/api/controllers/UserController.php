<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;
use yii\filters\auth\HttpBearerAuth;
use app\models\User;
use app\models\UsuarioFactory;
use app\models\UsuarioRefeicaoSearch;
use app\components\FormatterHelper;
use app\components\CalculateHelper;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    public function getTotalCalories() {
        $searchModel = new UsuarioRefeicaoSearch();
        $dataProvider = $searchModel->searchSumGroup(Yii::$app->request->queryParams);
        $result_models = $dataProvider->getModels();

        $total_calories = CalculateHelper::calculateColumn($result_models,'calorias_total');

        return $total_calories;
    }

    public function actionCalculate() {
        date_default_timezone_set('America/Sao_Paulo');

        $factory = new UsuarioFactory();
        $objeto_criado = $factory->createUser(Yii::$app->user->identity->sexo);
        $model = $objeto_criado->find()->where(['id' => Yii::$app->user->identity->id])->one();
        $total_calories = $this->getTotalCalories();
        $total_percentage = $model->calculaPorcentagemConsumida($total_calories);

        $results_calc = array(
            "imc" => FormatterHelper::formatBrazilian($model->imc),
            "classificacao_imc" => $model->classificacao_imc,
            "caf" => FormatterHelper::formatBrazilian($model->caf),
            "eer" => FormatterHelper::formatBrazilian($model->eer),
            "idade" => $model->idade,
            "tmb" => FormatterHelper::formatBrazilian($model->tmb),
            "valor_dieta" => $model->valor_dieta,
            "total_consumido" => FormatterHelper::formatBrazilian($model->total_consumido)
        );

        return $results_calc;
    }
}
