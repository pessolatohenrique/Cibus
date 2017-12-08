<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use app\models\GrupoAlimentar;

?>

<div class="grupo-alimentar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'descricao') ?>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Criar Grupo',['create'],
            [
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-target' => "#modal_grupo"
            ]
       )?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
Modal::begin([
    'header' => '<h5>Criar Grupo</h5>',
    'options' => ['id' =>  'modal_grupo']
]);

$model_add = new GrupoAlimentar();
echo $this->render('create', [
    'model' => $model_add,
]);

Modal::end();
?>