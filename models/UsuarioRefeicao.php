<?php

namespace app\models;

use Yii;
use app\components\DateHelper;
use yii\behaviors\TimestampBehavior;

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
    //alimentos de autopreenchimento
    public $medida_caseira;
    public $calorias_total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_refeicao';
    }

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
    public function rules()
    {
        return [
            [['usuario_id', 'refeicao_id', 'alimento_id', 'created_at', 'updated_at'], 'integer'],
            [['data_consumo', 'horario_consumo'], 'safe'],
            [['data_consumo', 'horario_consumo', 'alimento_id', 'refeicao_id', 'quantidade'], 'required', 'message' => 'O campo é de preenchimento obrigatório'],
            [['quantidade'], 'number'],
            [['alimento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alimento::className(), 'targetAttribute' => ['alimento_id' => 'id']],
            [['refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Refeicao::className(), 'targetAttribute' => ['refeicao_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }
    // ['username', 'required','message' => 'O campo usuário é de preenchimento obrigatório'],

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'refeicao_id' => 'Refeição',
            'alimento_id' => 'Alimento',
            'data_consumo' => 'Data do Consumo',
            'horario_consumo' => 'Horário do Consumo',
            'quantidade' => 'Quantidade',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * realiza a formatação de campos antes de salvar um registro
     * @return Boolean informação se salvou ou não o registro
     */
    public function beforeSave($insert) {
        $this->usuario_id = Yii::$app->user->identity->id;
        $this->data_consumo = DateHelper::toAmerican($this->data_consumo);
        return parent::beforeSave($insert);
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
