<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;
use yii\filters\auth\HttpBearerAuth;
use app\models\User;
use app\models\UsuarioFactory;
use app\components\FormatterHelper;

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

    public function actionCalculate() {
        $factory = new UsuarioFactory();
        $objeto_criado = $factory->createUser(Yii::$app->user->identity->sexo);
        $model = $objeto_criado->find()->where(['id' => Yii::$app->user->identity->id])->one();

        $results_calc = array(
            "imc" => FormatterHelper::formatBrazilian($model->imc),
            "classificacao_imc" => $model->classificacao_imc,
            "caf" => FormatterHelper::formatBrazilian($model->caf),
            "eer" => FormatterHelper::formatBrazilian($model->eer),
            "idade" => $model->idade,
            "tmb" => FormatterHelper::formatBrazilian($model->tmb),
            "valor_dieta" => $model->valor_dieta
        );

        return $results_calc;
    }
}
