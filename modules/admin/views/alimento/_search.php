<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use app\models\Planilha;
use app\models\PlanilhaUpload;
use app\models\GrupoAlimentar;

?>

<div class="alimento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <?= $form->field($model, 'descricao') ?>
        </div>
        <div class="col-md-4 col-sm-6">
            <?=$form->field($model, 'grupo_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($grupos, 'id', 'descricao'),
                'options' => [
                    'placeholder' => 'Selecione o grupo alimentar'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT,
            ]);?>
        </div>
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'medida_caseira') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Importar Planilha',['create'],
            [
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-target' => "#modal_planilha"
            ]
       )?>
       <?= Html::a('Criar', ['create'], 
       [
            'class' => 'btn btn-warning'
       ])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
Modal::begin([
    'header' => '<h5>Importar Planilha</h5>',
    'options' => ['id' => 'modal_planilha']
]);

$model_add = new Planilha();
$model_upload = new PlanilhaUpload();
echo $this->render('../planilha/create', [
    'model' => $model_add,
    'model_upload' => $model_upload
]);

Modal::end();
?>