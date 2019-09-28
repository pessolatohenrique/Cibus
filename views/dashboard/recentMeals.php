<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="recent-meals-index">
    <div class="box box-border box-info">
        <div class="box-header with-border">
            <h4 class="custom-title">Últimos alimentos consumidos</h4>
        </div>
        <div class="box-body table-responsive table-group">
            <?= GridView::widget([
                'dataProvider' => $mealDataProvider,
                'emptyText' => 'Não encontramos resultados!',
                'layout' => "{items}",
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Alimento',
                        'value' => 'alimento.descricao'
                    ],
                    [
                        'label' => 'Grupo alimentar',
                        'value' => 'alimento.grupo.descricao'
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
