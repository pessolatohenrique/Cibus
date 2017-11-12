<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use app\components\DateHelper;
use app\components\FormatterHelper;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'aceitaTermos'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'auth_key', 'password', 'photo', 'nome_completo', 'data_nascimento', 'sexo', 'nivelAtividade', 'role', 'altura', 'peso'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'username' => SORT_ASC                
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->data_nascimento != NULL){
            $this->data_nascimento = DateHelper::toAmerican($this->data_nascimento);    
        }

        $this->peso = FormatterHelper::formatDecimal($this->peso);
        
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nome_completo', $this->nome_completo])
            ->andFilterWhere(['sexo' => $this->sexo])
            ->andFilterWhere(['>=', 'data_nascimento', $this->data_nascimento])
            ->andFilterWhere(['>=', 'peso', $this->peso])
            ->andFilterWhere(['>=', 'altura', $this->altura])
            ->andFilterWhere(['nivelAtividade' => $this->nivelAtividade]);

        return $dataProvider;
    }
}
