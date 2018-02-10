<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dieta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dieta-form">

    <?php $form = ActiveForm::begin([
        'action' => [$action, 'id' => $model->id]
    ]); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= $form->field($model, 'valor_dieta')->textInput() ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
