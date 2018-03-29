<?php

namespace app\controllers;

use Yii;
use app\models\UsuarioRefeicao;
use app\models\UsuarioRefeicaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuarioRefeicaoController implements the CRUD actions for UsuarioRefeicao model.
 */
class UsuarioRefeicaoController extends Controller
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
     * Lists all UsuarioRefeicao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioRefeicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $meals = $searchModel->groupByMeal($dataProvider->getModels());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'meals' => $meals['Alimentos'],
            'meals_search' => UsuarioRefeicao::listMeals(),
            'foods_search' => UsuarioRefeicao::listFoods(),
            'groups_search' => UsuarioRefeicao::listGroups()
        ]);
    }

    /**
     * Displays a single UsuarioRefeicao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UsuarioRefeicao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsuarioRefeicao();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            if ($post['continua_insercao'] == 1) {
                \Yii::$app->getSession()->setFlash('success', 'Alimento adicionado na refeição com sucesso!');
                return $this->redirect(['create']);
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UsuarioRefeicao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UsuarioRefeicao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsuarioRefeicao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsuarioRefeicao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsuarioRefeicao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
