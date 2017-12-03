<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\components\FormatterHelper;
use app\components\StyleHelper;
?>
<h4>Histórico de IMC</h4>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'table table-responsive'],
    'columns' => [
        'data_lancamento',
        [
        	'attribute' => 'usuario.imc',
        	'label' => 'IMC',
        	'value' => function ($model){
        		return FormatterHelper::formatBrazilian($model->usuario->imc);
        	}
        ],
        [
        	'attribute' => 'usuario.classificacao_imc',
        	'label' => 'Classificação'
        ],
        [
        	'attribute' => 'diferenca_imc',
        	'headerOptions' => ['style' => 'width:10%'],
        	'format' => 'raw',
        	'label' => '',
        	'value' => function ($model){
        		$estilo = StyleHelper::getBadge($model->diferenca_imc);
        		$diferenca_imc = str_replace("-", "", $model->diferenca_imc);
        		$diferenca_imc = FormatterHelper::formatBrazilian($diferenca_imc);

        		return Html::tag('span', $diferenca_imc, [
        			'class' => $estilo
        		]);
        	}
        ]
    ],
]); ?>