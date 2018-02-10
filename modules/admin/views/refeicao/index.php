<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Refeições';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refeicao-index">
    
    <?php echo $this->render('_search', [
        'model' => $searchModel
    ]); ?>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    'descricao',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '70'],
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>