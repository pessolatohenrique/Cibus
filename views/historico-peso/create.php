<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HistoricoPeso */

$this->title = 'Create Historico Peso';
$this->params['breadcrumbs'][] = ['label' => 'Historico Pesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-peso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
