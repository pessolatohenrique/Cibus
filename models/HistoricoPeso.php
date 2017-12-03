<?php

namespace app\models;

use Yii;
use app\components\DateHelper;
use app\components\FormatterHelper;
use app\models\User;

/**
 * This is the model class for table "historico_peso".
 *
 * @property integer $id
 * @property integer $usuario_id
 * @property string $data_lancamento
 * @property string $peso
 *
 * @property User $usuario
 */
class HistoricoPeso extends \yii\db\ActiveRecord
{
    //atributos de pesquisa
    public $data_inicial;
    public $data_final;
    public $consolidado;

    //atributos calculados
    public $diferenca;
    public $diferenca_imc;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historico_peso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'integer'],
            [['data_lancamento'], 'safe'],
            [['peso'], 'string'],
            [['peso'], 'required', 'message' => 'O campo peso é de preenchimento obrigatório'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'data_lancamento' => 'Data Lançamento',
            'peso' => 'Peso',
            'consolidado' => 'Consolidado dos últimos 12 mêses'
        ];
    }

    /**
     * behavior do framework
     * o objetivo é formatar os dados após a busca em banco de dados
     * exemplos de uso: formatação de datas, valores decimais, entre outros
     * @return mixed
     */
    public function afterFind()
    {
        $this->data_lancamento = DateHelper::toBrazilian($this->data_lancamento);
        return parent::afterFind();
    }

    /**
     * behavior do framework
     * o objetivo é formatar os dados antes da inserção no banco de dados
     * @return mixed
     */
    public function beforeSave($insert)
    {
        $this->usuario_id = Yii::$app->user->identity->id;
        if (strpos($this->data_lancamento, "/") > 0)
        {
            $this->data_lancamento = DateHelper::toAmerican($this->data_lancamento);
        }
       
        $this->peso = FormatterHelper::formatDecimal($this->peso);

        $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $user->peso = $this->peso;
        $user->scenario = "noInsert";
        $user->save(false);

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    /**
     * com base em uma lista de resultados da tabela histórico peso,
     * obtém os apenas os pesos registrados, convetendo-os para float
     * Exemplo de utilização: gráfico de linhas
     * @param Array $resultados resultados encontrados na tabela historico_peso 
     * @return Array $pesos array com pesos encontrados e convertidos em float
     */
    public function obtemPesos($resultados)
    {
        $pesos = array_column($resultados, "peso");

        $pesos = array_map(function($item){
            $item = (float)$item;
            return $item;
        }, $pesos);
        
        return $pesos;
    }

    /**
     * calcula a diferença de pesos com base em uma lista de pesquisa
     * @param Array $pesos lista com pesos de uma pesquisa
     * @return Array $pesos_calc lista com coluna de calculado
     */
    public function calculaDiferenca($pesos)
    {
        $pesos_calc = $pesos;
        $pesos_calc[0]['diferenca'] = 0;
        
        for ($i = 1; $i < sizeof($pesos_calc); $i++)
        {
            $indice_anterior = $i - 1;
            $peso_anterior = $pesos_calc[$indice_anterior]->peso;
            $peso_atual = $pesos_calc[$i]->peso;
            $pesos_calc[$i]->diferenca = $peso_anterior - $peso_atual;
        }
        return $pesos_calc;
    }

    /**
     * calcula o imc com base em uma lista de pesquisa
     * @param Array $pesos lista de pesos de uma pesquisa 
     * @return Array $pesos_calc lista com coluna de imc calculado
     */
    public function calculaImcLote($pesos)
    {
        $pesos_calc = $pesos;
        
        foreach ($pesos_calc as $key => $peso_calc) {
            $usuario_relation = $peso_calc->usuario;
            $usuario_relation->peso = $peso_calc->peso;
            $imc = $usuario_relation->calculaImc();
            $classificacao = $usuario_relation->classificaImc();
        }

        return $pesos_calc;
    }

    /**
     * calcula a diferença de IMCs com base em uma lista de pesquisa
     * @param Array $pesos lista com pesos de uma pesquisa
     * @return Array $pesos_calc lista com coluna de calculado
     */
    public function calculaDiferencaImc($pesos)
    {
        $pesos_calc = $pesos;
        $pesos_calc[0]['diferenca_imc'] = 0;

        for ($i = 1; $i < sizeof($pesos_calc); $i++)
        {
            $indice_anterior = $i - 1;
            $imc_anterior = $pesos_calc[$indice_anterior]->usuario->imc;
            $imc_atual = $pesos_calc[$i]->usuario->imc;
            $pesos_calc[$i]->diferenca_imc = $imc_anterior - $imc_atual;
        }

        return $pesos_calc;
    }
}
