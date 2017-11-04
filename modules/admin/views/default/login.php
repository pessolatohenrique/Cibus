<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use app\models\PasswordResetRequestForm;

$this->title = 'Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Login</a>
    </div>
    <!-- /.login-logo -->
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <div class="login-box-body">
        <p class="login-box-msg">Realize o login para ter acesso ao sistema</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::a('Esqueci minha senha',['site/request-password-reset'],
                    [
                        'class' => 'btn btn-success',
                        'data-toggle' => 'modal',
                        'data-target' => "#w0"
                    ])?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

<?php
Modal::begin([
    'header' => '<h4>Esqueci minha senha</h4>',
]);
    $model_password = new PasswordResetRequestForm();
    echo $this->render('requestPasswordResetToken', [
        'model' => $model_password,
    ]);

Modal::end();
?>