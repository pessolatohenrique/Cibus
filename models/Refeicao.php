<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "refeicoes".
 *
 * @property int $id
 * @property string $descricao
 * @property int $created_at
 * @property int $updated_at
 */
class Refeicao extends \yii\db\ActiveRecord
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
        return 'refeicoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required', 'message' => 'Este campo é de preenchimento obrigatório'],
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
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    public function afterFind()
    {
        $this->created_at = date("d/m/Y", $this->created_at);   
        $this->updated_at = date("d/m/Y", $this->updated_at);   

    }
}
