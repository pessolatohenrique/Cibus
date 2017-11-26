<?php

$this->title = 'Dashboard';
?>

<div class="site-index">
	<?=$this->render('../dashboard/indicatives',[
		'model' => $model
	])?>
</div>
