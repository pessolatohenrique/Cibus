<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Cadastrar usuário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Preencha os campos abaixo para realizar o cadastro no sistema.</p>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'confirm_password')->passwordInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Cadastre-se', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>