<?php
namespace app\components;

class CalculateHelper
{
	/**
	 * realiza a soma de uma coluna com base em um array enviado via parâmetro
     * exemplo: total de calorias de acordo com um array de refeições
     * @param Array $array_search lista encontrada na pesquisa
     * @param String $column coluna desejada
	 * @return $sum somatório da coluna desejada, na lista de resultados
	 */
	public static function calculateColumn($array_search, $column)
	{
        $column_list = array_column($array_search, $column);
        $sum = array_sum($column_list);
        return $sum;
	}
}