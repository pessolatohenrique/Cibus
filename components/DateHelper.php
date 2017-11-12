<?php
namespace app\components;

class DateHelper
{
	/**
	 * converte uma data em formato brasileiro para o formato americano
	 * Exemplo: 26/05/1995 para 1995-05-26
	 * @param String $dateBrazilian data em formato brasileiro
	 * @return $date_american data formatada em formato americano
	 */
	public function toAmerican($dateBrazilian)
	{
		$date_explode = explode("/", $dateBrazilian);
		$date_american = $date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
		return $date_american;
	}

	/**
	 * converte uma data em formato americano para o formato brasileiro
	 * Exemplo: 1995-05-26 para 26/05/1995
	 * @param String $dateAmerican data em formato americano 
	 * @return $date_brazilian data formatada em formato brasileiro
	 */
	public function toBrazilian($dateAmerican)
	{
		$date_explode = explode("-", $dateAmerican);
		$date_brazilian = $date_explode[2]."/".$date_explode[1]."/".$date_explode[0];
		return $date_brazilian;
	}
}