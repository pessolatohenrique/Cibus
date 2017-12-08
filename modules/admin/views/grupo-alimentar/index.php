<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Grupo Alimentares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupoalimentar-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'descricao',
                    'valor_porcao',
                    ['class' => 'yii\grid\ActionColumn']
                ],
            ]); ?>
        </div>
    </div>

</div>
