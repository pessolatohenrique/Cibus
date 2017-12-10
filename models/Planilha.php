<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use app\models\Alimento;
use app\models\PlanilhaUpload;

/**
 * This is the model class for table "planilhas".
 *
 * @property integer $id
 * @property string $arquivo
 * @property string $descricao
 * @property integer $user_id
 *
 * @property User $user
 */
class Planilha extends \yii\db\ActiveRecord
{
    public $total_insert;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['arquivo', 'descricao'], 'required'],
            [['user_id'], 'integer'],
            [['arquivo', 'descricao'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'arquivo' => 'Arquivo',
            'descricao' => 'Descrição',
            'user_id' => 'User ID',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * behavior do framework
     * o objetivo é formatar os dados antes da inserção no banco de dados
     * @return mixed
     */
    public function beforeSave($insert)
    {
        $this->user_id = Yii::$app->user->identity->id;
        $this->saveUpload();
        $this->saveFields();
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * salva um upload de planilha realizado
     * @return void
     */
    public function saveUpload()
    {
        $model_upload = new PlanilhaUpload();
        $model_upload->sheetFile = UploadedFile::getInstance($model_upload, 'sheetFile');

        if ($model_upload->upload()) {
            $this->arquivo = $model_upload->complete_name;
        }
    }

    /**
     * realiza a leitura do arquivo CSV no qual foi transferido
     * verifica se o alimento já existe antes de realizar a inserção
     * @return Array $array_insert array com os dados lidos
     */
    public function readFile()
    {
        $alimentos = Alimento::find()->all();
        $coluna_descricao = array_column($alimentos, "descricao");
        $nome_arquivo = $this->arquivo;
        $array_insert = array();
        
        if (($handle = fopen($nome_arquivo, "r")) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $data[0] = utf8_encode($data[0]);
                $array_csv = explode(";", $data[0]);
                $existe_alimento = array_search($array_csv[0], $coluna_descricao);
                if($existe_alimento === false){
                    array_push($array_insert, $array_csv);    
                }
            }
            fclose($handle);
        }

        return $array_insert;
    }
    /**
     * salva os registros encontrados no arquivo CSV
     * @return void
     */
    public function saveFields()
    {
        $nome_arquivo = $this->arquivo;
        $array_insert = $this->readFile();

        if(!empty($array_insert))
        {
            array_shift($array_insert);
            Yii::$app->db->createCommand()->batchInsert(
                'alimentos', 
                ['descricao', 'medida_caseira', 'calorias', 'grupo_id'],
                $array_insert
            )->execute();

            $this->total_insert = count($array_insert);
        }

    }
}
