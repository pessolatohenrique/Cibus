<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DietaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dieta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?= $form->field($model, 'valor_dieta') ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?= $form->field($model, 'descricao') ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Criar Dieta',['create'],
            [
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-target' => "#modal_dieta"
            ]
       )?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
Modal::begin([
    'header' => '<h5>Criar Dieta</h5>',
    'options' => ['id' =>  'modal_dieta']
]);

$model_add = new \app\models\Dieta();
echo $this->render('create', [
    'model' => $model_add,
]);

Modal::end();
?>
