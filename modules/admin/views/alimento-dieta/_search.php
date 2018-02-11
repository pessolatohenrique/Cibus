<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlimentoDietaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alimento-dieta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'alimento_id') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'dieta_id') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Associar Alimento',['create', 'dieta_id' => $dieta->id],
            [
                'class' => 'btn btn-success'
            ]
       )?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
