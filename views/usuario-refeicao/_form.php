<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\assets\AlimentoAsset;

//campos que são carregados com preenchimento
date_default_timezone_set("America/Sao_Paulo");
$model->data_consumo = date("d/m/Y");
$model->horario_consumo = date("H:i");

if($model->quantidade == null) {
    $model->quantidade = 1;
}

AlimentoAsset::register($this);
?>

<div class="usuario-refeicao-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'formulario_dieta']
    ]); ?>

    <div class="loader">
        <div class="backLoading">
            <div class="load"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-4">
            <?= $form->field($model, 'data_consumo')->widget(MaskedInput::className(), [
                'mask' => '99/99/9999',
            ]) ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4">
            <?= $form->field($model, 'horario_consumo')->widget(MaskedInput::className(), [
                'mask' => '99:99',
            ]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?=$form->field($model, 'alimento_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($alimentos, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione o alimento',
                    'class' => 'cmb_alimento_refeicao',
                    'data-action' => '/admin/alimento/calculate'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4">
            <?= $form->field($model, 'quantidade')->textInput([
                'type' => 'number',
                'step' => '.50',
                'min' => '1',
                'class' => 'form-control quantidade_alimento_refeicao'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <?=$form->field($model, 'medida_caseira')->textInput([
                'disabled' => true,
                'class' => 'form-control medida_caseira_field'
            ])?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <?=$form->field($model, 'calorias_total')->textInput([
                'disabled' => true,
                'class' => 'form-control calorias_total'
            ])->label("Calorias")?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <?= $form->field($model, 'refeicao_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($refeicoes, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione a refeição'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
        <?php
        if($model->id === null):
        ?>
            <?= Html::submitButton('Salvar e criar outro', [
                'class' => 'btn btn-info btn-continue'
            ]) ?>
        <?php
        endif;
        ?>
    </div>

    <?= Html::hiddenInput('continua_insercao', 0, [
        'class' => 'continua_insercao'
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
