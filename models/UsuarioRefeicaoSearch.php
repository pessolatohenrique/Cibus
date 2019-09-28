<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\components\DateHelper;
use app\models\UsuarioRefeicao;
use yii\data\ActiveDataProvider;

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
            [['id', 'usuario_id', 'created_at', 'updated_at'], 'integer'],
            [['data_consumo', 'refeicao_id', 'alimento_id' ,'horario_consumo', 'data_inicial', 'data_final', 'grupo_id'], 'safe'],
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
        date_default_timezone_set('America/Sao_Paulo');

        $query = UsuarioRefeicao::find();
        $query->joinWith('alimento ali');
        $query->joinWith('refeicao ref');
        $query->join('LEFT JOIN', 'grupos_alimentares gru', 'ali.grupo_id = gru.id');
        $user_id = Yii::$app->user->identity->id;
    
        // add conditions that should always apply here
        $query->andWhere(['usuario_id' => $user_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query = $this->customSearch($query);

        // grid filtering conditions
        $query->andFilterWhere([
            'data_consumo' => $this->data_inicial
        ]);

        $query->andFilterWhere(['in', 'refeicao_id', $this->refeicao_id]);
        $query->andFilterWhere(['in', 'alimento_id', $this->alimento_id]);
        $query->andFilterWhere(['in', 'gru.id', $this->grupo_id]);

        return $dataProvider;
    }

    /**
     * customização de pesquisa. Por exemplo: datas em branco, formatação de datas
     * entre outros
     * @param Object $query objeto da query que está sendo construída
     * @return Object $new_query query modificada
     */
    public function customSearch($query) 
    {
        $new_query = $query;
        if ($this->data_inicial == null && $this->data_final == null) {
            $query->andWhere(['data_consumo' => date("Y-m-d")]);
        }

        if (strpos($this->data_inicial, "/") > 0) {
            $this->data_inicial = DateHelper::toAmerican($this->data_inicial);
        }

        return $new_query;
    }

    /**
     * realiza a somatória de calorias consumidas por refeição
     * utilizando conceitos de SUM e GROUP BY
     * @param Array $params dados pesquisados no search
     * @return Array $dataProvider provider fornecido pelo Yii2 com resultados encontrados
     */
    public function searchSumGroup($params) 
    {
        $query = UsuarioRefeicao::find()
        ->select([
            'SUM((usuario_refeicao.quantidade * alim.calorias)) AS calorias_total', 
            'refeicao_id', 'horario_consumo'
        ])
        ->joinWith('alimento alim')
        ->joinWith('refeicao')
        ->where(['usuario_id' => Yii::$app->user->identity->id])
        ->groupBy(['refeicao_id'])
        ->orderBy('refeicao_id', 'ASC');

        $this->load($params);
        $this->customSearch($query);

        // grid filtering conditions
        $query->andFilterWhere([
            'data_consumo' => $this->data_inicial
        ]);

        $query->andFilterWhere(['in', 'refeicao_id', $this->refeicao_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        return $dataProvider;
    }
    /**
     * realiza o agrupamento por refeicao de acordo com o resultado
     * @param Array $results resultado de uma busca da model UsuarioRefeicao
     * @return Array $group resultado agrupado
     */
    public function groupByMeal($results) {
        $group = array();
        $meals = array_unique(array_column($results, 'refeicao_id')); 
        sort($meals);

        if (count($meals) > 0) {
            foreach($meals as $key => $meal) {
                $arrayTmp = array();
                foreach($results as $key => $result) {
                    if ($result->refeicao_id == $meal) {
                        $result->data_consumo = DateHelper::toBrazilian($result->data_consumo);
                        $result->horario_consumo = DateHelper::formatTime($result->horario_consumo);
                        $result->calculaCalorias();
                        array_push($arrayTmp, $result);
                    }
                }
                array_push($group, $arrayTmp);
            }
        }

        $group = array_fill_keys(array('Alimentos'), $group);
        return $group;
    }
}
