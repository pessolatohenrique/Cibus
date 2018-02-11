<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AlimentoDieta */

$this->title = 'Update Alimento Dieta: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Alimento Dietas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alimento-dieta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
