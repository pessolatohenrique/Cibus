<?php
namespace app\models;

use Yii;
use app\models\User;
use app\behaviors\CalculateBehavior;
use app\interfaces\CalculavelInterface;

class Homem extends User implements CalculavelInterface
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            CalculateBehavior::className()
        ];
    }

    /**
     * @override
     * sobrescrita do método atribuiCaf, da classe mãe User
     * atribui o coeficiente de atividade físico (Caf) com valor de regra para homens
     * @return void
     */
    public function atribuiCaf()
    {
    	switch ($this->nivelAtividade)
    	{
    		case parent::COD_SEDENTARIO: $this->caf =  1.0; break;
    		case parent::COD_LEVE: $this->caf =  1.11; break;
    		case parent::COD_MODERADO: $this->caf =  1.25; break;
    		case parent::COD_INTENSO: $this->caf =  1.48; break;
    		default: $this->caf =  1.0; break; 
    	}
    }

    /**
     * @override
     * sobrescrita do método calculaEer, da interface Calculavel
     * calcula a necessidade de energia do usuário (EER) para homens
     * @return void
     */
    public function calculaEer()
    {
        $this->eer = 662 - 9.53 * $this->idade +
        	$this->caf * (15.91 * $this->peso + 539.6 * $this->altura);
    }

    /**
     * @override
     * sobrescrita do método calculaTmb, da interface calculavel
     * calcula a necessidade de taxa metabólica basal com o corpo TOTALMENTE (TMB) em repouso para homens
     * @return void
     */
	public function calculaTmb()
	{
		$this->tmb = 293 - 3.8 * $this->idade +
			456.4 * $this->altura + 10.12 * $this->peso;
	}
}