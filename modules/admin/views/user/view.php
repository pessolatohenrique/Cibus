<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "Usuário: ".$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="box">
        <div class="box-body">
            <img src="<?=Url::base()."/".$model->photo?>" alt="Imagem de perfil usuário" 
            class="img-circle img-small">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'email:email',
                    'nome_completo',
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
                            return ucfirst(Yii::$app->params['nivelAtividade'][$model->nivelAtividade]);
                        }
                    ],
                    'role',
                ],
            ]) ?>
        </div>
    </div>



</div>
