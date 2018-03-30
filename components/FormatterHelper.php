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
	public static function formatDecimal($value)
	{
		$format_value = str_replace(".", "", $value);
		$format_value = str_replace(",", ".", $value);
		return $format_value;
	}

	/**
	 * converte um número do banco de dados para o formato brasileiro
	 * exemplo: 62.50 será 62,50
	 * @param String $value valor a ser formatado 
	 * @return String $format_value
	 */
	public static function formatBrazilian($value)
	{
        $format_value = $value;
        if (strpos($value, ".") > 0) {
            $format_value = number_format($value, 2, ",", ".");
        }
    
		return $format_value;
	}
}