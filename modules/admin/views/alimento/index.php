<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Alimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-index">
    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'grupos' => $grupos
    ]); ?>

    <div class="box">
        <div class="box-body">
            <?php if (Yii::$app->session->hasFlash('inseriu_planilha')): ?>
             <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('inseriu_planilha') ?>
              </div>
            <?php endif; ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'descricao',
                    [
                        'label' => 'Grupo Alimentar',
                        'value' => function ($model) {
                            return $model->grupo->descricao;
                        }
                    ],
                    'medida_caseira',
                    'calorias',
                    ['class' => 'yii\grid\ActionColumn']
                ],
            ]); ?>
        </div>
    </div>

</div>