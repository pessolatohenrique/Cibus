<?php

use yii\helpers\Html;
use app\models\Alimento;
use app\models\Refeicao;

$this->title = 'Atualizar Alimento em uma Refeição';
$this->params['breadcrumbs'][] = ['label' => 'Refeições Realizadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="usuario-refeicao-create">
    <div class="box">
        <div class="box-header with-border">
            <h4 class="custom-title">Atualizar Alimento em uma Refeição</h4>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'alimentos' => Alimento::listDescription(),
                'refeicoes' => Refeicao::listDescription()
            ]) ?>
        </div>
    </div>


</div>
