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
        $user_id = Yii::$app->user->identity->id;
    
        // add conditions that should always apply here
        $query->andWhere(['usuario_id' => $user_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->data_inicial == null && $this->data_final == null) {
            $query->andWhere(['data_consumo' => date("Y-m-d")]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id
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
