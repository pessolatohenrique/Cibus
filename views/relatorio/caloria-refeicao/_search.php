<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\components\DateHelper;

if(strpos($model->data_inicial, "-") > 0){
    $model->data_inicial = DateHelper::toBrazilian($model->data_inicial);
}
?>

<div class="usuario-refeicao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['/relatorio/calorias-refeicao'],
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
   
            <fieldset class="fieldset-no-style">
                <legend>Refeições Realizadas</legend>
                <?= $form->field($model, 'refeicao_id')->checkboxList (
                    ArrayHelper::map($meals_search, 'refeicao_id', 'refeicao.descricao'), 
                    [
                        'class' => 'checkboxgroup',
                        'separator' => '<br>'
                    ]
                )->label("Selecione") ?>
            </fieldset>

            <div class="form-group">
                <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
                <?= Html::button('Limpar filtros', ['class' => 'btn btn-info limpa_filtro ']) ?>
            </div>
        
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
