<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Refeicao */

$this->title = 'Atualizar Refeição: '.$model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Refeicaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="refeicao-update">

    <?= $this->render('_form', [
        'model' => $model,
        'action' => 'update'
    ]) ?>

</div>
