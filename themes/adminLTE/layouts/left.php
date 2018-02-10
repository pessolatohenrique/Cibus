<?php
use yii\helpers\Url;
$foto_perfil = Yii::$app->user->identity->photo;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=Url::base()?>/<?=$foto_perfil?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Administrador', 'options' => ['class' => 'header']],
                    ['label' => 'Usuários', 'icon' => 'users', 'url' => ['/admin/user']],
                    ['label' => 'Grupos Alimentares', 'icon' => 'users', 'url' => ['/admin/grupo-alimentar']],
                    ['label' => 'Alimentos', 'icon' => 'users', 'url' => ['/admin/alimento']],
                    ['label' => 'Planilhas', 'icon' => 'users', 'url' => ['/admin/planilha']],
                    ['label' => 'Refeições', 'icon' => 'users', 'url' => ['/admin/refeicao']],
                    ['label' => 'Dietas', 'icon' => 'users', 'url' => ['/admin/dieta']],
                ],
            ]
        ) ?>

    </section>

</aside>
