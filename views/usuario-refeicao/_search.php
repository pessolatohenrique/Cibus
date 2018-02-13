<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioRefeicaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-refeicao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="box box-border box-success">
        <div class="box-body">
            <fieldset>
                <legend>Data da Refeição</legend>
                <?= $form->field($model, 'data_inicial') ?>
                <?= $form->field($model, 'data_final') ?>
            </fieldset>

            <fieldset>
                <legend>Refeições Realizadas</legend>
                <?= $form->field($model, 'refeicao_id')->checkboxList ([
                    1 => 'Refeição 1',
                    2 => 'Refeição 2',
                    3 => 'Refeição 3',
                    4 => 'Refeição 4',
                    5 => 'Refeição 5',
                    6 => 'Refeição 6',
                ], [
                    'class' => 'checkboxgroup',
                    'separator' => '<br>'
                ])->label("Selecione") ?>
            </fieldset>

            <fieldset>
                <legend>Alimentos Consumidos</legend>
                <?= $form->field($model, 'alimento_id')->checkboxList ([
                    1 => 'Alimento 1',
                    2 => 'Alimento 2',
                    3 => 'Alimento 3'
                ], [
                    'class' => 'checkboxgroup',
                    'separator' => '<br>'
                ])->label("Selecione") ?>
            </fieldset>

            <fieldset>
                <legend>Grupo Alimentar</legend>
                <?= $form->field($model, 'grupo_id')->checkboxList ([
                    1 => 'Grupo 1',
                    2 => 'Grupo 2',
                    3 => 'Grupo 3'
                ], [
                    'class' => 'checkboxgroup',
                    'separator' => '<br>'
                ])->label("Selecione") ?>
            </fieldset>

            <div class="form-group">
                <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
                <?= Html::submitButton('Limpar filtros', ['class' => 'btn btn-info']) ?>
            </div>
        
        </div>
    </div>




    <?php ActiveForm::end(); ?>

</div>
