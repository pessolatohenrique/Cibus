<?php
namespace app\models;
use Yii;
use app\models\User;
use app\behaviors\CalculateBehavior;
use app\interfaces\CalculavelInterface;

class Mulher extends User implements CalculavelInterface
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
     * sobrescrita do método atribuiCaf, interface Calculavel
     * atribui o coeficiente de atividade físico (Caf) com valor de regra para mulheres
     * @return void
     */
    public function atribuiCaf()
    {
        switch ($this->nivelAtividade)
        {
            case parent::COD_SEDENTARIO: $this->caf =  1.0; break;
            case parent::COD_LEVE: $this->caf =  1.12; break;
            case parent::COD_MODERADO: $this->caf =  1.27; break;
            case parent::COD_INTENSO: $this->caf =  1.45; break;
            default: $this->caf =  1.0; break; 
        }
    }

    /**
     * @override
     * sobrescrita do método calculaEer, da interface Calculavel
     * calcula a necessidade de energia do usuário (EER) para mulheres
     * @return void
     */
    public function calculaEer()
    {
        $this->eer = 354 - (6.91 * $this->idade) + $this->caf * (9.36 * $this->peso + 726 * $this->altura);
    }

    /**
     * @override
     * sobrescrita do método calculaTmb, da interface calculavel
     * calcula a necessidade de taxa metabólica basal com o corpo TOTALMENTE (TMB) em repouso para homens
     * @return void
     */
    public function calculaTmb()
    {
        $this->tmb = 247 - 2.67 * $this->idade +
            401.5 * $this->altura + 8.6 * $this->peso;
    }
}