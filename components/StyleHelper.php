<?php
namespace app\components;

class StyleHelper
{
	/**
	 * verifica o estilo do badge (componente de estilo) de acordo com o valor fornecido
	 * para este método, são definidos estilos para valor positivo ou negativo
	 * @param Float $valor valor fornecido por uma consulta ou algo semelhante
	 * @return $estilo classe CSS a ser aplicada
	 */
	public function getBadge($valor)
	{
		$estilo = "badge negative-badge";
		if ($valor >= 0) {
			$estilo = "badge positive-badge";
		}
		
		return $estilo;
	}
}