<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dieta */

$this->title = 'Atualizar Dieta: '.$model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Dietas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descricao, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dieta-update">

    <?= $this->render('_form', [
        'model' => $model,
        'action' => 'update'
    ]) ?>

</div>
