<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Alimento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alimento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grupo_id')->textInput() ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'medida_caseira')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calorias')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
