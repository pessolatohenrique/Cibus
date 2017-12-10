<?php

namespace app\models;

use Yii;

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
}
