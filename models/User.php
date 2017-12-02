<?php
namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\behaviors\FormatFieldsBehavior;
use app\behaviors\InsertHistoryBehavior;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password
 * @property string $photo
 * @property string $nome_completo
 * @property string $data_nascimento
 * @property string $sexo
 * @property double $altura
 * @property double $peso
 * @property string $nivelAtividade
 * @property integer $aceitaTermos
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const COD_SEDENTARIO = 0;
    const COD_LEVE = 1;
    const COD_MODERADO = 2;
    const COD_INTENSO = 3;

    public $password_repeat;
    //atributos calculados
    public $imc;
    public $classificacao_imc;
    public $caf;
    public $eer;
    public $idade;
    public $tmb;
    public $valor_dieta;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            FormatFieldsBehavior::className(),
            InsertHistoryBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'aceitaTermos'], 'integer'],
            [['data_nascimento'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'auth_key', 'password', 'photo', 'nome_completo', 'altura', 'peso'], 'string', 'max' => 255],
            [['sexo', 'nivelAtividade'], 'string', 'max' => 1],
            ['username', 'trim'],
            ['username', 'required','message' => 'O campo usuário é de preenchimento obrigatório'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Este usuário já existe em nossa base de dados'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required','message' => 'O campo email é de preenchimento obrigatório'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Este e-mail já existe em nossa base de dados'],
            ['password', 'required','message' => 'O campo senha é de preenchimento obrigatório'],
            ['password', 'string', 'min' => 4],
            ['password_repeat', 'required', 'message' => 'A confirmação da senha não pode ficar em branco'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"A confirmação da senha deve ser igual a senha informada" ],
            ['data_nascimento', 'required', 'message' => 'O campo data de nascimento é de preenchimento obrigatório'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Usuário',
            'password' => 'Senha',
            'nome_completo' => 'Nome Completo',
            'data_nascimento' => 'Data Nascimento',
            'sexo' => 'Sexo',
            'altura' => 'Altura',
            'peso' => 'Peso',
            'nivelAtividade' => 'Nivel Atividade',
            'aceitaTermos' => 'Aceita Termos',
            'password_repeat' => 'Confirme a senha'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $this->setPassword($this->password);
        $this->generateAuthKey();
        return $this->save(false) ? $this : null;
    }

    public function classificaImc()
    {
        if ($this->imc < 16){
            $this->classificacao_imc = "Desnutrição grau 3";
        }elseif($this->imc >= 16 && $this->imc <= 17.9){
            $this->classificacao_imc = "Desnutrição grau 2";
        }elseif($this->imc >= 18 && $this->imc <= 18.4){
            $this->classificacao_imc = "Desnutrição grau 1";
        }elseif($this->imc >= 18.5 && $this->imc <= 24.9){
            $this->classificacao_imc = "Eutrofia";
        }elseif($this->imc >= 25 && $this->imc <= 29.9){
            $this->classificacao_imc = "Sobrepeso";
        }elseif($this->imc >= 30 && $this->imc <= 34.9){
            $this->classificacao_imc = "Obesidade grau 1";
        }elseif($this->imc >= 35 && $this->imc <= 39.9){
            $this->classificacao_imc = "Obesidade grau 2";
        }else{
            $this->classificacao_imc = "Obesidade grau 3";
        }
    }

    /**
     * realiza o cálculo do índice de massa corporal (IMC)
     * para um usuário específico
     * @return void
     */
    public function calculaImc()
    {
        $total_imc = $this->peso / ($this->altura * $this->altura);
        $this->imc = $total_imc;
    }

    /**
     * calcula a idade do usuário em anos
     * @return void
     */
    public function calculaIdade()
    {
        $data1 = new \DateTime(date("Y-m-d"));
        $data2 = new \DateTime($this->data_nascimento);
        $intervalo = $data1->diff( $data2 );
        $this->idade = $intervalo->y;
    }

    /**
     * seleciona o valor de dieta do usuário
     * valor selecionado de acordo com o eer
     * @return void
     */
    public function selecionaDieta()
    {
        if($this->eer <= 1900){
            $this->valor_dieta = 1900;
        }elseif($this->eer > 1900 && $this->eer <= 2500){
            $this->valor_dieta = 2500;
        }else{
            $this->valor_dieta = 2800;
        }
    }

}