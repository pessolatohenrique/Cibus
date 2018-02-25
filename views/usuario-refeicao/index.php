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
                'model' => $searchModel,
                'meals_search' => $meals_search,
                'foods_search' => $foods_search,
                'groups_search' => $groups_search
            ])?>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8">
            <?php 
            if (empty($meals)):
            ?>
                <?= $this->render('_refeicoes_not_found')?>
            <?php
            endif;
            ?>
            
            <?= $this->render('_lista-refeicoes', [
                'model' => $searchModel,
                'meals' => $meals
            ])?>
        </div>
    </div>
</div>