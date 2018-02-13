<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_refeicao".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $refeicao_id
 * @property int $alimento_id
 * @property string $data_consumo
 * @property string $horario_consumo
 * @property double $quantidade
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Alimento $alimento
 * @property Refeicao $refeicao
 * @property User $usuario
 */
class UsuarioRefeicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_refeicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'refeicao_id', 'alimento_id', 'created_at', 'updated_at'], 'integer'],
            [['data_consumo', 'horario_consumo'], 'safe'],
            [['quantidade'], 'number'],
            [['alimento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alimento::className(), 'targetAttribute' => ['alimento_id' => 'id']],
            [['refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Refeicao::className(), 'targetAttribute' => ['refeicao_id' => 'id']],
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
            'refeicao_id' => 'Refeicao ID',
            'alimento_id' => 'Alimento ID',
            'data_consumo' => 'Data Consumo',
            'horario_consumo' => 'Horario Consumo',
            'quantidade' => 'Quantidade',
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
    public function getRefeicao()
    {
        return $this->hasOne(Refeicao::className(), ['id' => 'refeicao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }
}
