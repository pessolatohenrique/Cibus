<?php

namespace app\controllers;

use Yii;
use app\models\UsuarioRefeicao;
use app\components\CalculateHelper;
use app\models\UsuarioRefeicaoSearch;

class RelatorioController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $theme = "basic";
            if (Yii::$app->request->cookies['theme']) {
                $theme = Yii::$app->request->cookies->getValue('theme');
            }
            Yii::$app->view->theme = new \yii\base\Theme([
                'pathMap' => ['@app/views' => '@app/themes/'.$theme],
                'baseUrl' => '@web',

            ]);
            return true;  // or false if needed
        } else {
            return false;
        }
    }

    public function actionCaloriasRefeicao()
    {
        $searchModel = new UsuarioRefeicaoSearch();
        $model = new UsuarioRefeicao();
        $dataProvider = $searchModel->searchSumGroup(Yii::$app->request->queryParams);
        $result_models = $dataProvider->getModels();

        return $this->render('caloria-refeicao/index', [
            'searchModel' => $searchModel,
            'meals_search' => UsuarioRefeicao::listMeals(),
            'dataProvider' => $dataProvider,
            'total_calories' => CalculateHelper::calculateColumn($result_models,'calorias_total'),
            'pizza_chart' => $model->generatePizzaChart($result_models),
            'meals_columns' => $model->generateMealColumns($result_models),
            'meals_values' => $model->generateMealValues($result_models)
        ]);
    }

}
