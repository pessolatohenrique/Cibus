<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Dietas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refeicao-index">
    
    <?php echo $this->render('_search', [
        'model' => $searchModel
    ]); ?>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    'descricao',
                    'valor_dieta',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'headerOptions' => ['width' => '70'],
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    Url::to(['alimento-dieta/index', 'dieta_id' => $model->id]), 
                                    [
                                        'data-pjax'=>true,
                                        'action'=>Url::to(['alimento-dieta/index', 
                                            'dieta_id' => $model->id])
                                    ]
                                );
                            }
                        ]
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>