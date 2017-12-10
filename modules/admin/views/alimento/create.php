<?php

use yii\helpers\Html;

$this->title = 'Novo Alimento';
$this->params['breadcrumbs'][] = ['label' => 'Alimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-create">

    <?= $this->render('_form', [
        'model' => $model,
        'grupos' => $grupos
    ]) ?>

</div>
