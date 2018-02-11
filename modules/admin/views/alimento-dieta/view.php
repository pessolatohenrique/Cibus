<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AlimentoDieta */

$this->title = $model->fullDescription;
$this->params['breadcrumbs'][] = ['label' => 'Dieta', 'url' => [
    'index',
    'dieta_id' => $dieta->id
]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-dieta-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'refeicao.descricao',
                'label' => 'Refeição'
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
            'alimento.calorias'
        ],
    ]) ?>

</div>
