<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Refeicao */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Refeicaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refeicao-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'descricao',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
