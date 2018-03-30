<?php
use yii\grid\GridView;

?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-border box-info">
            <div class="box-header with-border">
                <h4 class="custom-title">Tabela de calorias consumidas</h4>
                <p>
                    Você consumiu <strong><?=$total_calories?></strong> 
                    calorias no período e nas refeições abaixo.
                </p>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => '',
                    'options' => ['class' => 'table table-responsive'],
                    'columns' => [
                        'refeicao.descricao',
                        'horario_consumo',
                        'calorias_total'
                    ]
                ]); ?>
            </div>
        </div>
    </div>
</div>
