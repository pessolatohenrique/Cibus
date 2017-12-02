<?php

namespace app\models;

use Yii;
use app\components\DateHelper;

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
            [['peso'], 'number'],
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
            'data_lancamento' => 'Data Lancamento',
            'peso' => 'Peso',
            'consolidado' => 'Consolidado dos últimos 12 mêses'
        ];
    }

    /**
     * behavior do framework
     * o objetivo é formatar os dados após a busca em banco de dados
     * exemplos de uso: formatação de datas, valores decimais, entre outros
     * @return type
     */
    public function afterFind()
    {
        $this->data_lancamento = DateHelper::toBrazilian($this->data_lancamento);
        return parent::afterFind();
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
}
