<?php
namespace app\components;

use Yii;
/**
 * helper referente a tratamento de imagens
 * exemplos de métodos: tratar o nome de uma imagem
 */
class ImageHelper
{
	public function generateName($original_name)
	{
		$datetime = date("Ymdhis");
		$name = $datetime.$original_name;
		$new_name = md5($name);
		return $new_name;
	}
}