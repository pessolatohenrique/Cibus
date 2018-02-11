<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alimento_dieta".
 *
 * @property int $id
 * @property int $alimento_id
 * @property int $dieta_id
 * @property int $refeicao_id
 * @property string $porcao
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Alimentos $alimento
 * @property Alimentos $dieta
 * @property Refeicoes $refeicao
 */
class AlimentoDieta extends \yii\db\ActiveRecord
{
    public $medida_caseira;
    public $grupo_alimentar;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alimento_dieta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alimento_id', 'dieta_id', 'refeicao_id', 'created_at', 'updated_at'], 'integer'],
            [['porcao'], 'string', 'max' => 5],
            [['alimento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alimento::className(), 'targetAttribute' => ['alimento_id' => 'id']],
            [['dieta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dieta::className(), 'targetAttribute' => ['dieta_id' => 'id']],
            [['refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Refeicao::className(), 'targetAttribute' => ['refeicao_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alimento_id' => 'Alimento',
            'dieta_id' => 'Dieta ID',
            'refeicao_id' => 'Refeição',
            'porcao' => 'Porção',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimento()
    {
        return $this->hasOne(Alimento::className(), ['id' => 'alimento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDieta()
    {
        return $this->hasOne(Alimento::className(), ['id' => 'dieta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefeicao()
    {
        return $this->hasOne(Refeicao::className(), ['id' => 'refeicao_id']);
    }

    /**
     * obtem o concatenado entre a refeição e o alimento
     * @return String $complete_description
     */
    public function getFullDescription()
    {
        return $this->refeicao->descricao." - ".$this->alimento->descricao;
    }
}
