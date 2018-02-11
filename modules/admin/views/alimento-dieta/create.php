<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\AlimentoDieta */
$this->title = 'Associar alimento à dieta de '.$dieta->valor_dieta." kcal";
$this->params['breadcrumbs'][] = [
    'label' => 'Dieta', 
    'url' => ['index', 'dieta_id' => $dieta->id]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-dieta-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dieta' => $dieta,
        'alimentos' => $alimentos,
        'refeicoes' => $refeicoes
    ]) ?>

</div>
