<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dietas".
 *
 * @property int $id
 * @property int $valor_dieta
 * @property string $descricao
 * @property int $created_at
 * @property int $updated_at
 */
class Dieta extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dietas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor_dieta'], 'required', 'message' => 'As calorias são de preenchimento obrigatório'],
            [['valor_dieta', 'created_at', 'updated_at'], 'integer', 'message' => 'Este campo precisa ser um número inteiro'],
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
            'valor_dieta' => 'Calorias',
            'descricao' => 'Descrição',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    /**
     * método que será chamado após a busca de registros
     * @return void
     */
    public function afterFind()
    {
        $this->created_at = date("d/m/Y", $this->created_at);
        $this->updated_at = date("d/m/Y", $this->updated_at);
    }
}
