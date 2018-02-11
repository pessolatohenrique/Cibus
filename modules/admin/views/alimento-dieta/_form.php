<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\assets\AlimentoAsset;

AlimentoAsset::register($this);
?>

<div class="alimento-dieta-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'formulario_dieta']
    ]); ?>
    <div class="loader">
        <div class="backLoading">
            <div class="load"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <?=$form->field($model, 'alimento_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($alimentos, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione o alimento',
                    'class' => 'cmb_alimento',
                    'data-action' => Url::home()."admin/alimento/search"
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT,
            ]);?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'porcao')->textInput() ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'medida_caseira')->textInput([
                'disabled' => true,
                'class' => 'form-control medida_caseira_field'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'grupo_alimentar')->textInput([
                'disabled' => true,
                'class' => 'form-control grupo_alimentar_field'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?=$form->field($model, 'refeicao_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($refeicoes, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione a refeição'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT,
            ]);?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('Salvar e criar outro', [
            'class' => 'btn btn-primary btn-continue'
        ]) ?>
    </div>
    <?= $form->field($model, 'dieta_id')->hiddenInput(['value'=> $dieta->id])->label(false); ?>
    <?= Html::hiddenInput('continua_insercao', 0, [
        'class' => 'continua_insercao'
    ]); ?>


    <?php ActiveForm::end(); ?>

</div>
