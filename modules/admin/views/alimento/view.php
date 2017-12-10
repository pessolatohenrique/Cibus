<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoAlimentar */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Alimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-alimentar-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'descricao',
            [
                'label' => 'Grupo Alimentar',
                'value' => function ($model) {
                    return $model->grupo->descricao;
                }
            ],
            'medida_caseira',
            'calorias',
        ],
    ]) ?>

</div>