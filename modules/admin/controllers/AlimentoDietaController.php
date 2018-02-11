<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Dieta;
use yii\web\Controller;
use app\models\Alimento;
use app\models\Refeicao;
use yii\filters\VerbFilter;
use app\models\AlimentoDieta;
use app\models\GrupoAlimentar;
use yii\web\NotFoundHttpException;
use app\models\AlimentoDietaSearch;
use yii\filters\AccessControl;

/**
 * AlimentoDietaController implements the CRUD actions for AlimentoDieta model.
 */
class AlimentoDietaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'roles' => ['manageDiet'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AlimentoDieta models.
     * @return mixed
     */
    public function actionIndex($dieta_id)
    {
        $searchModel = new AlimentoDietaSearch();
        $dataProvider = $searchModel->search($dieta_id, Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dieta' => Dieta::find()->where(['id' => $dieta_id])->one(),
            'refeicoes' => Refeicao::listDescription(),
            'alimentos' => Alimento::listDescription(),
            'grupos_alimentares' => GrupoAlimentar::listDescription()
        ]);
    }

    /**
     * Displays a single AlimentoDieta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($dieta_id, $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dieta' => Dieta::find()->where(['id' => $dieta_id])->one()
        ]);
    }

    /**
     * Creates a new AlimentoDieta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($dieta_id)
    {
        $model = new AlimentoDieta();
        $dieta = Dieta::find()->where(['id' => $dieta_id])->one();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            if ($post['continua_insercao'] == 1) {
                \Yii::$app->getSession()->setFlash('success', 'Alimento associado com sucesso!');
                return $this->redirect(['create', 'dieta_id' => $dieta_id]);
            } 
            return $this->redirect(['index', 'dieta_id' => $dieta_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'dieta' => $dieta,
            'alimentos' => Alimento::listDescription(),
            'refeicoes' => Refeicao::listDescription()
        ]);
    }

    /**
     * Updates an existing AlimentoDieta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($dieta_id, $id)
    {
        $model = $this->findModel($id);
        $dieta = Dieta::find()->where(['id' => $dieta_id])->one();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            if ($post['continua_insercao'] == 1) {
                \Yii::$app->getSession()->setFlash('success', 'Alimento associado com sucesso!');
                return $this->redirect(['create', 'dieta_id' => $dieta_id]);
            } 
            return $this->redirect(['index', 'dieta_id' => $dieta_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dieta' => $dieta,
            'alimentos' => Alimento::listDescription(),
            'refeicoes' => Refeicao::listDescription()
        ]);
    }

    /**
     * Deletes an existing AlimentoDieta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($dieta_id, $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'dieta_id' => $dieta_id]);
    }

    /**
     * Finds the AlimentoDieta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AlimentoDieta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AlimentoDieta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
