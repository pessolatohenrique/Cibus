<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoricoPeso */

$this->title = 'Update Historico Peso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Historico Pesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="historico-peso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
