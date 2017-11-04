<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Shopping</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Adicionar Novo
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=Url::base()?>/index.php?r=categoria/create">Categoria</a></li>
                        <li><a href="<?=Url::base()?>/index.php?r=filme/create">Filme</a></li>
                        <li><a href="<?=Url::base()?>/index.php?r=gastronomia/create">Gastronomia</a></li>
                        <li><a href="<?=Url::base()?>/index.php?r=loja/create">Loja</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pesquisar
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=Url::base()?>/index.php?r=quadro_horario">Agenda de Filmes</a></li>
                        <li><a href="<?=Url::base()?>/index.php?r=categoria">Categoria</a></li>
                        <li><a href="<?=Url::base()?>/index.php?r=filme">Filme</a></li>
                        <li><a href="<?=Url::base()?>/index.php?r=gastronomia">Gastronomia</a></li>
                        <li><a href="<?=Url::base()?>/index.php?r=loja">Loja</a></li>
                    </ul>
                </li>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="fa fa-user"></span> <strong>Nome do usuário</strong></a></li>
                    <li><a href="#"><span class="fa fa-sign-out"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container" style="padding:0;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer-main">
    <div class="row">
        <div class="col-md-10">
            <p>
                O sistema permite o gerenciamento de um shopping.<br>
                Permite o gerenciamento de filmes, gastronomia e lojas, estando disponível para a parte administrativa do shopping e usuário final.
            </p>
            <p>
                Desenvolvido por <strong>Henrique Pessolato</strong>
            </p>
        </div>
        <div class="col-md-2">
            <ul class="social">
                <li>
                    <a href="http://pessolatohenrique.esy.es/" target="_blank">
                        <i class="fa fa-code fa-3x" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="https://github.com/pessolatohenrique" target="_blank">
                        <i class="fa fa-github fa-3x" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="https://br.linkedin.com/in/henrique-pessolato-436aba6a" target="_blank">
                        <i class="fa fa-linkedin fa-3x" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>