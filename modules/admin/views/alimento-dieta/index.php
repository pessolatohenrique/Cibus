<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = $dieta->descricao;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-dieta-index">
    
    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'dieta' => $dieta,
        'refeicoes' => $refeicoes,
        'alimentos' => $alimentos,
        'grupos_alimentares' => $grupos_alimentares
    ]); ?>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pjax' => true,
                'striped' => true,
                'hover' => true,
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    [
                        'attribute'=> 'refeicao_id', 
                        'width'=>'310px',
                        'value'=>function ($model, $key, $index, $widget) { 
                            return $model->refeicao->descricao;
                        },
                        'group'=>true,  // enable grouping
                    ],
                    [
                        'attribute' => 'alimento.descricao',
                        'label' => 'Alimento'    
                    ],
                    [
                        'attribute' => 'alimento.grupo.descricao',
                        'label' => 'Grupo Alimentar'
                    ],
                    'porcao',
                    [
                        'attribute' => 'alimento.medida_caseira',
                        'label' => 'Medida Caseira'
                    ],
                    'alimento.calorias',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '80'],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) use ($dieta) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    Url::to([
                                        'view',
                                        'id' => $model->id, 
                                        'dieta_id' => $dieta->id
                                    ])
                                );
                            },
                            'update' => function ($url, $model, $key) use ($dieta) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-pencil"></span>',
                                    Url::to([
                                        'update',
                                        'id' => $model->id, 
                                        'dieta_id' => $dieta->id
                                    ])
                                );
                            },
                            'delete' => function ($url, $model, $key) use ($dieta) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-trash"></span>',
                                    Url::toRoute([
                                        'delete',
                                        'id' => $model->id, 
                                        'dieta_id' => $dieta->id,
                                    ]),
                                    ['data-method' => 'POST']
                                );
                            },
                        ]
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>