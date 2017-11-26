<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use app\components\DateHelper;

$model->data_nascimento = DateHelper::toBrazilian($model->data_nascimento);
$model->peso = number_format($model->peso,2);
?>

<div class="user-form box box-border box-success">
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model_upload, 'imageFile')->fileInput()->label("Foto de Perfil") ?>
        
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?= $form->field($model, 'nome_completo')->textInput() ?>
            </div>
            <div class="col-md-4 col-sm-12">
                <?= $form->field($model, 'email') ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <?= $form->field($model, 'data_nascimento')->widget(MaskedInput::className(), [
                    'mask' => '99/99/9999',
                ]) ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?=$form->field($model, 'sexo')->widget(Select2::classname(), [
                    'data' => Yii::$app->params['sexo'],
                    'options' => [
                        'placeholder' => 'Selecione o Sexo'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'theme' => Select2::THEME_BOOTSTRAP,
                ]);?>
            </div>
            <div class="col-md-2 col-sm-4">
                <?= $form->field($model, 'nivelAtividade')->widget(Select2::classname(), [
                    'data' => array_map(function($item){
                        return ucfirst($item);
                    },Yii::$app->params['nivelAtividade']),
                    'options' => [
                        'placeholder' => 'Selecione o nível de atividade'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'theme' => Select2::THEME_BOOTSTRAP,
                ]); ?>
            </div>
            <div class="col-md-2 col-sm-4">
                <?= $form->field($model, 'peso')->textInput([
                     'class' => 'form-control number-decimal'
                ]) ?>
            </div>
            <div class="col-md-2 col-sm-4">
                <?= $form->field($model, 'altura')->textInput([
                    'class' => 'form-control number-decimal'
                ]) ?>
            </div>
        </div>    

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Atualizar', ['class' =>'btn btn-primary btn-align']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
