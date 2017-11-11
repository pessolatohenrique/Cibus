<?php
namespace app\components;

class FormatterHelper
{
	/**
	 * converte um número decimal para o formato do banco de dados
	 * exemplo: 62,50 será 62.5
	 * @param String $value valor a ser formatado 
	 * @return String $format_value
	 */
	public function formatDecimal($value)
	{
		$format_value = str_replace(".", "", $value);
		$format_value = str_replace(",", ".", $value);
		return $format_value;
	}
}