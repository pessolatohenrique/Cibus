<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoAlimentar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-alimentar-form">

    <?php $form = ActiveForm::begin([
    	'action' => [$action, 'id' => $model->id],
    ]); ?>

    <div class="row">
    	<div class="col-md-8">
    		<?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-4">
    		<?= $form->field($model, 'valor_porcao')->textInput() ?>
    	</div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
