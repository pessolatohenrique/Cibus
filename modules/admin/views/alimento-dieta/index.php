<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = $dieta->descricao;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-dieta-index">
    
    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'dieta' => $dieta
    ]); ?>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    'alimento_id',
                    'refeicao_id',
                    'porcao',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '70'],
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>