<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'table table-responsive'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    'nome_completo',
                    'email',
                    [
                        'attribute' => 'data_nascimento',
                        'value' => function($model){
                            if($model->data_nascimento != ""){
                                return Yii::$app->formatter->asDate($model->data_nascimento,'php:d/m/Y');
                            }
                          
                        }
                    ],
                    [
                        'attribute' => 'sexo',
                        'value' => function($model){
                            $sexo = $model->sexo;
                            return Yii::$app->params['sexo'][$sexo];
                        }
                    ],
                    [
                        'attribute' => 'peso',
                        'value' => function($model){
                            return number_format($model->peso, 2, ",", ".");
                        }
                    ],
                    [
                        'attribute' => 'altura',
                        'value' => function($model){
                            return number_format($model->altura, 2, ",", ".");
                        }
                    ],
                    [
                        'attribute' => 'nivelAtividade',
                        'value' => function($model){
                            if(isset($model->nivelAtividade)){
                                return ucwords(Yii::$app->params['nivelAtividade'][$model->nivelAtividade]);
                            }
                            
                        }
                    ],
                    'role',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
