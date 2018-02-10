<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefeicaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refeicao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?= $form->field($model, 'descricao') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Criar Refeição',['create'],
            [
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-target' => "#modal_refeicao"
            ]
       )?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
Modal::begin([
    'header' => '<h5>Criar Refeição</h5>',
    'options' => ['id' =>  'modal_refeicao']
]);

$model_add = new \app\models\Refeicao();
echo $this->render('create', [
    'model' => $model_add,
]);

Modal::end();
?>