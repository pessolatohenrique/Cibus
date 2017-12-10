<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Alimento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alimento-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-3 col-sm-6"> 
            <?=$form->field($model, 'grupo_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($grupos, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione o grupo alimentar'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT,
            ]);?>
    	</div>
    	<div class="col-md-3 col-sm-6">
    		<?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-3 col-sm-6">
    		<?= $form->field($model, 'medida_caseira')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-md-3 col-sm-6">
    		<?= $form->field($model, 'calorias')->textInput() ?>
    	</div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
