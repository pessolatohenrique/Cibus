<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use app\models\Alimento;
use yii\filters\VerbFilter;
use app\models\AlimentoSearch;
use app\models\GrupoAlimentar;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * AlimentoController implements the CRUD actions for Alimento model.
 */
class AlimentoController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'search'],
                        'roles' => ['manageFood'],
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'actions' => ['calculate'],
                        'roles' => ['@'],
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
     * Lists all Alimento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlimentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'grupos' => GrupoAlimentar::find()->orderBy("descricao","ASC")->all()
        ]);
    }

    /**
     * Displays a single Alimento model.
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
     * Creates a new Alimento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Alimento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'grupos' => GrupoAlimentar::find()->orderBy("descricao","ASC")->all()
            ]);
        }
    }

    /**
     * Updates an existing Alimento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'grupos' => GrupoAlimentar::find()->orderBy("descricao","ASC")->all()
            ]);
        }
    }

    /**
     * Deletes an existing Alimento model.
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
     * realiza a busca de um alimento através de um ID
     * o objetivo é trazer informações adicionais, tais como medida caseira e grupo alimentar
     * @param Integer $id identificador do alimento
     * @return void
     */
    public function actionSearch($id)
    {
        $alimento = Alimento::find()->where(['id' => $id])->one();
        $retorno = array();
        
        if (count($alimento) > 0) {
            $retorno = array(
                'grupo' => $alimento->grupo->descricao,
                'medida_caseira' => $alimento->medida_caseira
            );
        }
        
        echo Json::encode($retorno);
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
        $retorno = array();

        // if (array_key_exists("id", $alimento)) {
            $alimento->calculaCalorias($quantidade);
            $retorno = array(
                'medida_caseira' => $alimento->medida_caseira,
                'calorias' => $alimento->total_calorias
            );
        // }
        // var_dump($retorno); die;
        echo Json::encode($retorno);
    }

    /**
     * Finds the Alimento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alimento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alimento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
