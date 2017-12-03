<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\bootstrap\Modal;
use app\components\DateHelper;
use app\models\HistoricoPeso;

if(strpos($model->data_inicial, "-") > 0){
    $model->data_inicial = DateHelper::toBrazilian($model->data_inicial);
}
if(strpos($model->data_final, "-") > 0){
    $model->data_final = DateHelper::toBrazilian($model->data_final);
}

?>

<div class="historico-peso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'data_inicial')->widget(MaskedInput::className(), [
        'mask' => '99/99/9999',
    ]) ?>

    <?= $form->field($model, 'data_final')->widget(MaskedInput::className(), [
        'mask' => '99/99/9999',
    ]) ?>

    <?= $form->field($model, 'consolidado')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Adicionar Histórico',['historico-peso/create13'],
            [
                'class' => 'btn btn-info',
                'data-toggle' => 'modal',
                'data-target' => "#modal_historico"
            ]
       )?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
Modal::begin([
    'header' => '<h5>Adicionar Histórico</h5>',
    'options' => ['id' => 'modal_historico']
]);

$model_historico = new HistoricoPeso();
echo $this->renderAjax('create', [
    'model' => $model_historico,
]);

Modal::end();