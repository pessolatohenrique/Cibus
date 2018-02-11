<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupos_alimentares".
 *
 * @property integer $id
 * @property string $descricao
 * @property double $valor_porcao
 * @property integer $created_at
 * @property integer $updated_at
 */
class GrupoAlimentar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupos_alimentares';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'valor_porcao'], 'required'],
            [['valor_porcao'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['descricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
            'valor_porcao' => 'Valor Porção',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * realiza a listagem dos campos "ID" e "Descricao" da tabela de grupos alimentares
     * o objetivo é otimizar a busca
     * @return Array $grupos grupos alimentares encontrados
     */
    public function listDescription()
    {
        $query = self::find()->orderBy('descricao', 'ASC');
        $grupos = $query->all();
        return $grupos;
    }
}
