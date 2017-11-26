<?php
namespace app\interfaces;
use Yii;

/**
 * interface com métodos de cálculos a serem implementados
 * Exemplos de cálculo: IMC, TMB, EER, CAF, entre outros
 */
interface CalculavelInterface {
	public function calculaImc();
	public function classificaImc();
	public function atribuiCaf();
	public function calculaEer();
	public function calculaTmb();
}