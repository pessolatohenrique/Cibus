<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="planilha-form">

	<?php $form = ActiveForm::begin([
		'action' => ['planilha/create'],
		'options' => ['enctype' => 'multipart/form-data']
	]) ?>

    <?= $form->field($model_upload, 'sheetFile')->fileInput()->label("Arquivo (Formato CSV)") ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
