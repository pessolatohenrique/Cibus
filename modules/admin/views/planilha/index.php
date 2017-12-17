<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Planilhas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilha-index">
    
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
                        'label' => 'Data de importação',
                        'value' => 'created_at'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '30'],
                        'template' =>'{view}'
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>