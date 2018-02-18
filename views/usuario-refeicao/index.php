<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\Alimento;
use app\models\UsuarioRefeicao;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioRefeicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Refeições Realizadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-refeicao-index">
    <div class="form-group">
        <?= Html::a('Adicionar Alimento',['usuario-refeicao/create'],
            [
                'class' => 'btn btn-primary'
            ]
       )?>
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <?= $this->render('_search', [
                'model' => $searchModel
            ])?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <?= $this->render('_lista-refeicoes', [
                'model' => $searchModel
            ])?>
        </div>
    </div>
</div>