<?php

use yii\helpers\Html;
use app\models\Alimento;
use app\models\Refeicao;

/* @var $this yii\web\View */
/* @var $model app\models\AlimentoDieta */

$this->title = 'Atualizar: '.$model->fullDescription;
$this->params['breadcrumbs'][] = ['label' => 'Dieta', 'url' => [
    'index',
    'dieta_id' => $dieta->id
]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="alimento-dieta-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dieta' => $dieta,
        'alimentos' => Alimento::listDescription(),
        'refeicoes' => Refeicao::listDescription()
    ]) ?>

</div>
