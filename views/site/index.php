<?php

$this->title = 'Dashboard';

?>

<div class="site-index">
	<?=$this->render('../dashboard/indicatives',[
		'model' => $model,
		'total_calories' => $total_calories
	])?>

	<div class="row">
		<div class="col-md-6">
			<?=$this->render("../relatorio/caloria-refeicao/_grafico-pizza", [
				'pizza_chart' => $caloriesChart,
				'from_dashboard' => 1
			])
			?>
		</div>
		<div class="col-md-6">
			<div class="box box-border box-info">
            	<div class="box-header with-border">
					<h4 class="custom-title">
						Histórico de peso
					</h4>
				</div>
				<div class="box-body">
					<?=$this->render("../historico-peso/line-chart", [
						'datas_lancamento' => $weightDates,
						'pesos' => $weightValues,
						'from_dashboard' => 1
					])
					?>
				</div>
			</div>
		</div>
	</div>
	<?=$this->render('../dashboard/recentMeals', [
		'mealDataProvider' => $mealDataProvider
	])?>
</div>
