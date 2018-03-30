<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\Alimento;
use app\models\UsuarioRefeicao;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioRefeicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calorias por Refeição';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calorias-refeicao-index">    
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <?= $this->render('_search', [
                'model' => $searchModel,
                'meals_search' => $meals_search
            ])?>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8">            
            <?= $this->render('_tabela-consumidos', [
                'dataProvider' => $dataProvider,
                'total_calories' => $total_calories
            ])?>

            <?php
            if (count($pizza_chart) > 0):
            ?>
                <?=$this->render('_grafico-pizza', [
                    'pizza_chart' => $pizza_chart
                ])?>
            <?php
            endif;
            ?>

            <?=$this->render('_grafico-barra',[
                'meals_columns' => $meals_columns,
                'meals_values' => $meals_values
            ]);?>
        </div>
    </div>
</div>