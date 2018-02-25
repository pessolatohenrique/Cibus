<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\components\DateHelper;

if (strpos($model->data_inicial, "-") > 0) {
    $model->data_inicial = DateHelper::toBrazilian($model->data_inicial);
}

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
                <?= $form->field($model, 'data_inicial')->widget(MaskedInput::className(), [
                    'mask' => '99/99/9999',
                ])->label("Data") ?>
            </fieldset>
   
            <fieldset>
                <legend>Refeições Realizadas</legend>
                <?= $form->field($model, 'refeicao_id')->checkboxList (
                    ArrayHelper::map($meals_search, 'refeicao_id', 'refeicao.descricao'), 
                    [
                        'class' => 'checkboxgroup',
                        'separator' => '<br>'
                    ]
                )->label("Selecione") ?>
            </fieldset>

            <fieldset>
                <legend>Alimentos Consumidos</legend>
                <?= $form->field($model, 'alimento_id')->checkboxList ( 
                ArrayHelper::map($foods_search, 'alimento_id', 'alimento.descricao'),
                [
                    'class' => 'checkboxgroup',
                    'separator' => '<br>'
                ])->label("Selecione") ?>
            </fieldset>

            <fieldset>
                <legend>Grupo Alimentar</legend>
                <?= $form->field($model, 'grupo_id')->checkboxList (
                    ArrayHelper::map($groups_search, 
                        'alimento.grupo.id', 
                        'alimento.grupo.descricao'
                    ),
                [
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
