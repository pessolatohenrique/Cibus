<?php
use app\components\FormatterHelper;
?>	

<section class="indicativos">
	<div class="row margin-row">
		<div class="col-md-4 col-sm-6">
			<div class="box box-theme">
				<div class="box-body">
					<p class="text-center text-white">
						Olá, <?=Yii::$app->user->identity->username?>!
						<br>
						<span class="info-text"><?=$total_calories?> kcal</span>
						foram consumidas hoje
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
			<div class="box box-theme">
				<div class="box-body">
					<p class="text-center text-white">
						A sua dieta é de:
						<span class="info-text"><?=$model->valor_dieta?> kcal</span>
						(estimativa de consumo energético)
					</p>
				</div>

			</div>
		</div>
		<div class="col-md-4 col-sm-6">
			<div class="box box-theme">
				<div class="box-body">
					<p class="text-center text-white">
						Índice de massa corporal (IMC):
						<span class="info-longtext"><?=$model->classificacao_imc?></span>
						O cálculo resultou em <?=FormatterHelper::formatBrazilian($model->imc)?>
					</p>
				</div>

			</div>
		</div>
	</div>
</section>