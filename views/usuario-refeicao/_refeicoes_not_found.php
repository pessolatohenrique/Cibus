<?php

use yii\helpers\Html;

?>

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-border box-info">
        <div class="box-header with-border">
            <h4 class="custom-title">Não encontramos refeições! :(</h4>
        </div>
        <div class="box-body">
            <p class="text-center">
                A pesquisa não retornou nenhuma refeição realizada.
                Caso queira adicionar alimentos em uma refeição, clique 
                <?= Html::a('aqui!',['usuario-refeicao/create'],
                    [
                        'class' => ''
                    ]
                )?>
            </p>
        </div>
    </div>
</div>