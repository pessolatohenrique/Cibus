<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\components\StyleHelper;
use app\components\FormatterHelper;

?>
<h4>Histórico de Peso</h4>
<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'options' => ['class' => 'table table-responsive'],
	'columns' => [
		'data_lancamento',
		[
			'attribute' => 'peso',
			'value' => function ($model){
				return FormatterHelper::formatBrazilian($model->peso);
			}
		],
		[
			'attribute' => 'diferenca',
			'headerOptions' => ['style' => 'width:10%'],
			'format' => 'raw',
			'label' => '',
			'value' => function($model){
				$estilo = StyleHelper::getBadge($model->diferenca);
				$diferenca = str_replace("-", "", $model->diferenca);
				$diferenca = FormatterHelper::formatBrazilian($diferenca);

				return Html::tag('span', $diferenca, [
					'class' => $estilo
				]);
			}
		]                    
	],
]); ?>