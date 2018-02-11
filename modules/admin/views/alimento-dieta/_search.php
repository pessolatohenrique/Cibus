<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AlimentoDietaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alimento-dieta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
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
        <div class="col-lg-4 col-md-4 col-sm-6">
            <?=$form->field($model, 'alimento_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($alimentos, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione o alimento'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT,
            ]);?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <?=$form->field($model, 'grupo_pesquisa')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($grupos_alimentares, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione o grupo alimentar'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT,
            ])->label("Grupo Alimentar");?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Associar Alimento',['create', 'dieta_id' => $dieta->id],
            [
                'class' => 'btn btn-success'
            ]
       )?>
    </div>
    <?= $form->field($model, 'dieta_id')->hiddenInput(['value'=> $dieta->id])->label(false); ?>
    <?= Html::hiddenInput('dieta_id', $dieta->id); ?>
    <?php ActiveForm::end(); ?>

</div>
