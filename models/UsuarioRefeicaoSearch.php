<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuarioRefeicao;

/**
 * UsuarioRefeicaoSearch represents the model behind the search form of `app\models\UsuarioRefeicao`.
 */
class UsuarioRefeicaoSearch extends UsuarioRefeicao
{
    //atributos de pesquisa
    public $data_inicial;
    public $data_final;
    public $grupo_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'refeicao_id', 'alimento_id', 'created_at', 'updated_at'], 'integer'],
            [['data_consumo', 'horario_consumo', 'data_inicial', 'data_final', 'grupo_id'], 'safe'],
            [['quantidade'], 'number'],
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
        $query = UsuarioRefeicao::find();

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
            'usuario_id' => $this->usuario_id,
            'refeicao_id' => $this->refeicao_id,
            'alimento_id' => $this->alimento_id,
            'data_consumo' => $this->data_consumo,
            'horario_consumo' => $this->horario_consumo,
            'quantidade' => $this->quantidade,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
