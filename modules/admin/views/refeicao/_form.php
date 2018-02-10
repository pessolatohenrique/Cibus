<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Refeicao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refeicao-form">

    <?php $form = ActiveForm::begin([
        'action' => [$action, 'id' => $model->id],
    ]); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
