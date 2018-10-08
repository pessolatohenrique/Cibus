<?php
namespace app\models;
use Yii;
use yii\base\DynamicModel;
use yii\base\Exception;
use app\models\Homem;
use app\models\Mulher;

class UsuarioFactory
{
	private $classes = array("M" => "Homem", "F" => "Mulher");
	/**
	 * verifica o sexo do usuário e realiza a criação da classe adequada
	 * segue o design pattern FactoryMethod
	 * o objetivo é dinamizar o procedimento de herança e polimorfismo
	 * @param $sexo sexo do usuário logado
	 * @return $userObj instância de um objeto
	 */
	public function createUser($sexo)
	{
		$sexo = strtoupper($sexo);
		if (array_key_exists ($sexo, $this->classes)){
			$objeto = "app\\models\\".$this->classes[$sexo];
			return new $objeto;
        }
        
        throw new Exception("Parâmetro inválido");
	}
}