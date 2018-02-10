<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dieta */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Dietas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dieta-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'valor_dieta',
            'descricao',
            'created_at',
            'updated_at'
        ],
    ]) ?>

</div>
