<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-request-password-reset">

    <p>Informe o seu e-mail. As instruções para gerar uma nova senha serão enviadas nele.</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
                'id' => 'request-password-reset-form',
                'action' => ['request-password-reset']
            ]); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>