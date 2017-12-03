<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$model->data_lancamento = date("d/m/Y");
?>

<div class="historico-peso-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-historico',
        'action' => ['create']    
	]); ?>

    <div class="row">
    	<div class="col-md-6">
		    <?= $form->field($model, 'data_lancamento')->widget(MaskedInput::className(), [
        		'mask' => '99/99/9999',
    		]) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'peso')->textInput([
    			'class' => 'form-control number-decimal'
    		]) ?>
    	</div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
