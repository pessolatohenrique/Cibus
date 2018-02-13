<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioRefeicao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-refeicao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'refeicao_id')->textInput() ?>

    <?= $form->field($model, 'alimento_id')->textInput() ?>

    <?= $form->field($model, 'data_consumo')->textInput() ?>

    <?= $form->field($model, 'horario_consumo')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
