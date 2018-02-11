<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AlimentoDieta;

/**
 * AlimentoDietaSearch represents the model behind the search form of `app\models\AlimentoDieta`.
 */
class AlimentoDietaSearch extends AlimentoDieta
{
    public $grupo_pesquisa;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'alimento_id', 'dieta_id', 'refeicao_id', 'grupo_pesquisa' ,'created_at', 'updated_at'], 'integer'],
            [['porcao'], 'number'],
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
    public function search($dieta_id, $params)
    {
        $query = AlimentoDieta::find();
        $query->joinWith('alimento');

        // add conditions that should always apply here
        $query->andWhere(['dieta_id' => $dieta_id]);

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
            'alimento_id' => $this->alimento_id,
            'refeicao_id' => $this->refeicao_id,
            // 'grupo_pesquisa' => $this->grupo_pesquisa,
        ]);
        $query->andFilterWhere(['alimentos.grupo_id' => $this->grupo_pesquisa]);
        
        return $dataProvider;
    }
}
