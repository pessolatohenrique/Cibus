<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoAlimentar */

$this->title = 'Atualizar Grupo Alimentar: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Grupos Alimentares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descricao, 'url' => ['view', 'id' => $model->descricao]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="grupo-alimentar-update">

    <?= $this->render('_form', [
        'model' => $model,
        'action' => $action
    ]) ?>

</div>
