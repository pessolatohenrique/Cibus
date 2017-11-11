<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use app\models\PasswordResetRequestForm;
use app\models\User;

$this->title = 'Cibus Nutrição | Login';
?>
<div class="header-login">
     <h1 class="text-center">
        <i class="fa fa-apple fa-3x" aria-hidden="true"></i>
        <br>
        Login
    </h1>
</div>
<div class="login-box">
    <!-- /.login-logo -->
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Usuário") ?>

            <?= $form->field($model, 'password')->passwordInput()->label("Senha") ?>

            <?= $form->field($model, 'rememberMe')->checkbox()->label("Lembrar Senha") ?>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::a('Esqueci minha senha',['site/request-password-reset'],
                    [
                        'class' => 'btn btn-info',
                        'data-toggle' => 'modal',
                        'data-target' => "#w0"
                    ])?>
            </div>

        <?php ActiveForm::end(); ?>

        <p class="text-center">
            Não possui uma conta?
            <?= Html::a('Registre-se',['#'],
                [
                    'data-toggle' => 'modal',
                    'data-target' => "#register"
                ]
            )?>
        </p>
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

<?php
Modal::begin([
    'header' => '<h4>Criar Conta</h4>',
    'id' => 'register',
    'options' => ['tabindex' => 0]
]);
    $model = new User();
    echo $this->render('signup', [
        'model' => $model,
        'model_upload' => $model_upload
    ]);
Modal::end();
?>