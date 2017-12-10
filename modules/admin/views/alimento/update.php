<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alimento */

$this->title = 'Atualizar: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Alimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descricao, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="alimento-update">

    <?= $this->render('_form', [
        'model' => $model,
        'grupos' => $grupos
    ]) ?>

</div>
