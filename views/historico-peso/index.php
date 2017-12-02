<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistoricoPesoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cibus | Relatório de Peso e IMC';
$this->params['breadcrumbs'][] = "Relatório de Peso e IMC";
?>
<section class="relatorio-peso">
    <h3>Relatório de Peso e IMC</h3>
    <div class="box box-border box-success">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                     <?=$this->render('_search', ['model' => $searchModel]); ?>
                </div>
                <div class="col-md-9">
                    <?php 
                    if(!empty($datas_lancamento)):
                    ?>
                        <?=$this->render('line-chart', [
                            'model' => $searchModel,
                            'datas_lancamento' => $datas_lancamento,
                            "pesos" => $pesos
                        ])?>
                    <?php
                    else:
                    ?>
                        <p class="pesquisa-invalida">
                            Não houve lançamento de dados durante o período informado na pesquisa!
                        </p>
                    <?php
                    endif;
                    ?>
                </div>
            </div>

            <div class="row">
                
            </div>
        </div>
    </div>
   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'usuario_id',
            'data_lancamento',
            'peso',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</section>
