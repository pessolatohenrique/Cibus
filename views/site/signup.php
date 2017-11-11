<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;

?>
<div class="site-signup">

    <p>Preencha os campos abaixo para realizar o cadastro no sistema.</p>
    <?php $form = ActiveForm::begin([
        'id' => 'form-signup',
        'action' => ['signup'],
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model_upload, 'imageFile')->fileInput()->label("Foto de Perfil") ?>
    
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'nome_completo')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'data_nascimento')->widget(MaskedInput::className(), [
                'mask' => '99/99/9999',
            ]) ?>
        </div>
        <div class="col-md-6">
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
    </div>

    <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-4">
            <?= $form->field($model, 'peso')->textInput([
                 'class' => 'form-control number-decimal'
            ]) ?>
        </div>  
        <div class="col-md-4">
            <?= $form->field($model, 'altura')->textInput([
                'class' => 'form-control number-decimal'
            ]) ?>
        </div>  
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>
    
    <div class="row">
        <div class="col-md-12 checkbox-space">
            <?= $form->field($model, 'aceitaTermos')->checkbox()
            ->label(
                "Concordo com os termos e condições apresentados <a href='#'>aqui</a>"
            );
            ?>
        </div>
    </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Cadastre-se', [
            'class' => 'btn btn-primary', 
            'name' => 'signup-button',
            'id' => 'btn-register'
        ]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>