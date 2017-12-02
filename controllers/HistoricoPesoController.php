<?php

namespace app\controllers;

use Yii;
use app\models\HistoricoPeso;
use app\models\HistoricoPesoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * HistoricoPesoController implements the CRUD actions for HistoricoPeso model.
 */
class HistoricoPesoController extends Controller
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

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HistoricoPeso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HistoricoPesoSearch();
        $result = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $result
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'datas_lancamento' => array_column($result, "data_lancamento"),
            'pesos' => HistoricoPeso::obtemPesos($result)
        ]);
    }

    /**
     * Displays a single HistoricoPeso model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HistoricoPeso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HistoricoPeso();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HistoricoPeso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HistoricoPeso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HistoricoPeso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HistoricoPeso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HistoricoPeso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
