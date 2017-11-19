<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
$isVisitor = Yii::$app->user->isGuest;
$foto_perfil = !$isVisitor?Yii::$app->user->identity->photo:"";
if(!$isVisitor):
?>
    <nav class="navbar navbar-nav navbar-default navbar-fixed-top" id="w0">
        <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse_id">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <?= Html::a(
                    Yii::$app->name,
                    ['/site'],
                    ['class' => 'navbar-brand']
                ) ?>
            </div>
            <ul class="nav navbar-nav navbar-align collapse navbar-collapse" id="collapse_id">
                <li class="">
                    <?= Html::a(
                        'Home',
                        ['/site']
                    ) ?>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
                <li class="option-mobile"><a href="#">Configurações</a></li>
                <li class="option-mobile">
                    <?= Html::a(
                        'Logout',
                        ['/site/logout'],
                        ['data-method' => 'post']
                    ) ?>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img src="<?=Url::base()?>/<?=$foto_perfil?>" class="img-circle profile-image" alt="User Image"/>
                        <?=Yii::$app->user->identity->username?>
                    </a>
                    <ul class="dropdown-menu full-dropdown">
                        <li>                            
                            <?= Html::a(
                                'Configurações',
                                ['/user/update', 'id' => Yii::$app->user->identity->id]
                            ) ?>    
                        </li>
                        <li>
                            <?= Html::a(
                                'Logout',
                                ['/site/logout'],
                                ['data-method' => 'post']
                            ) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
<?php
endif;
?>