<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use app\components\DateHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
if($model->data_nascimento != NULL){
    $model->data_nascimento = DateHelper::toBrazilian($model->data_nascimento);
}
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'username') ?>
        </div> 
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'nome_completo') ?>
        </div>
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <?= $form->field($model, 'data_nascimento')->widget(MaskedInput::className(), [
                'mask' => '99/99/9999',
            ])->label("Data Nascimento (maior ou igual à)") ?>
        </div>
        <div class="col-md-2 col-sm-6">
            <?=$form->field($model, 'sexo')->widget(Select2::classname(), [
                'data' => Yii::$app->params['sexo'],
                'options' => [
                    'placeholder' => 'Selecione o Sexo'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT,
            ]);?>
        </div>
        <div class="col-md-2 col-sm-6">
            <?= $form->field($model, 'peso')->textInput([
                 'class' => 'form-control number-decimal'
            ])->label("Peso (maior ou igual à)") ?>
        </div>  
        <div class="col-md-2 col-sm-6">
            <?= $form->field($model, 'altura')->textInput([
                'class' => 'form-control number-decimal'
            ])->label("Altura (maior ou igual)") ?>
        </div>  
        <div class="col-md-2">
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
                'theme' => Select2::THEME_DEFAULT,
            ]); ?>
        </div>  
    </div>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
