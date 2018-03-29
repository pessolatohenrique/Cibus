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

    /**
     * calcula a quantidade consumida de um grupo de alimentos em uma refeição
     * @param Array $meal alimentos consumidos na refeição
     * @return Float $sum valores somados
     */
    public static function sumQuantity($meal)
    {
        $sum = 0;
        $quantities = array_column($meal, 'quantidade');
        $sum = array_sum($quantities);
        return $sum;
    }

    /**
     * calcula o total de calorias consumidas de um grupo de alimentos em uma refeição
     * @param Array $meal alimentos consumidos na refeição
     * @return Float $sum valores somados
     */
    public static function sumCalories($meal)
    {
        $sum = 0;
        $calorias = array_column($meal, 'calorias_total');
        $sum = array_sum($calorias);
        return $sum;
    }

    /**
     * calcula o total de calorias consumidas para um alimento
     * @return Float $total total consumido
     */
    public function calculaCalorias()
    {
        $calorias = $this->alimento->calorias;
        $this->calorias_total = $this->quantidade * $calorias;
    }

    /**
     * realiza listagem de refeições que um usuário já realizou
     * essa listagem independente da data de realização
     * @return Array $meals lista com refeições realizadas
     */
    public static function listMeals()
    {
        $query = UsuarioRefeicao::find()
        ->select(['usuario_refeicao.refeicao_id', 'ref.descricao'])
        ->distinct()
        ->joinWith('refeicao ref')
        ->where(['usuario_id' => Yii::$app->user->identity->id])
        ->orderBy('ref.id', 'ASC');

        $meals = $query->all();

        return $meals;
    }

    /**
     * realiza a listagem de alimentos que o usuário já consumiu
     * essa listagem idnependente da data de realização
     * @return Array $foods lista com alimentos consumidos
     */
    public static function listFoods()
    {
        $query = UsuarioRefeicao::find()
        ->select(['usuario_refeicao.alimento_id', 'ali.descricao'])
        ->distinct()
        ->joinWith('alimento ali')
        ->where(['usuario_id' => Yii::$app->user->identity->id])
        ->orderBy('ali.descricao', 'ASC');

        $foods = $query->all();

        return $foods;
    }

    /**
     * realiza a listagem de grupos alimentares que o usuário já consumiu
     * essa listagem indepente da data de realização
     * @return Array $groups lista com grupos consumidos
     */
    public static function listGroups()
    {
        $query = UsuarioRefeicao::find()
        ->select(['usuario_refeicao.alimento_id', 'ali.grupo_id', 'gru.descricao'])
        ->distinct()
        ->joinWith('alimento ali')
        ->join('LEFT JOIN', 'grupos_alimentares gru', 'ali.grupo_id = gru.id')
        ->where(['usuario_id' => Yii::$app->user->identity->id])
        ->orderBy('gru.descricao', 'ASC');

        $groups = $query->all();

        return $groups;
    }
}
