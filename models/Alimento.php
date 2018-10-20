<?php

namespace app\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "alimentos".
 *
 * @property integer $id
 * @property integer $grupo_id
 * @property string $descricao
 * @property string $medida_caseira
 * @property double $calorias
 *
 * @property GruposAlimentares $grupo
 */
class Alimento extends \yii\db\ActiveRecord
{
    public $total_calorias;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alimentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grupo_id', 'descricao', 'medida_caseira', 'calorias'], 'required'],
            [['grupo_id'], 'integer'],
            [['calorias'], 'number'],
            [['descricao', 'medida_caseira'], 'string', 'max' => 255],
            [['grupo_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoAlimentar::className(), 'targetAttribute' => ['grupo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grupo_id' => 'Grupo Alimentar',
            'descricao' => 'Descrição',
            'medida_caseira' => 'Medida Caseira',
            'calorias' => 'Calorias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(GrupoAlimentar::className(), ['id' => 'grupo_id']);
    }

    /**
     * lista todos os valores dos campos "id" e "descricao" dos alimentos
     * o objetivo de listar apenas este campo é otimizar a consulta SQL
     *
     * @return Array $foods lista de alimentos encontrados
     */
    public static function listDescription()
    {
        $query = self::find()->select(['id','descricao'])->orderBy('descricao','ASC');
        $foods = $query->all();
        return $foods;
    }

    /**
     * calcula o total de calorias de acordo com a quantidade
     * @param Float $quantidade quantidade consumida
     * @return void
     */
    public function calculaCalorias($quantidade)
    {
        $this->total_calorias = 0;

        if ($quantidade <= 0) {
            throw new Exception("A quantidade deve ser maior ou igual à 1!");
        }

        if ($quantidade != "") {
            $this->total_calorias = $this->calorias * $quantidade;
        }
    }
}
