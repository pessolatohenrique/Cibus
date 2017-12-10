<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alimento;

/**
 * AlimentoSearch represents the model behind the search form about `app\models\Alimento`.
 */
class AlimentoSearch extends Alimento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grupo_id'], 'integer'],
            [['descricao', 'medida_caseira'], 'safe'],
            [['calorias'], 'number'],
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
        $query = Alimento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'grupo_id' => $this->grupo_id,
            'calorias' => $this->calorias,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'medida_caseira', $this->medida_caseira]);

        return $dataProvider;
    }
}
