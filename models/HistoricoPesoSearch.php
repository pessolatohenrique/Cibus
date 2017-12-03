<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistoricoPeso;
use app\components\DateHelper;

/**
 * HistoricoPesoSearch represents the model behind the search form about `app\models\HistoricoPeso`.
 */
class HistoricoPesoSearch extends HistoricoPeso
{
    //atributos de pesquisa
    public $data_inicial;
    public $data_final;
    public $consolidado;
    const CONSOLIDADO = 1;
    const NAO_CONSOLIDADO = 0;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['data_lancamento', 'data_inicial', 'data_final', 'consolidado'], 'safe'],
            [['peso'], 'number'],
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
        $query = HistoricoPeso::find();

        // add conditions that should always apply here
        $query->where(['usuario_id' => Yii::$app->user->identity->id]);

        $this->data_inicial = DateHelper::calculatePast(30,date("Y-m-d"));
        $this->data_final = date("Y-m-d");
        $this->load($params);

        if($this->consolidado == self::NAO_CONSOLIDADO){
            $this->searchByInterval($query);
        }else{
            $this->searchGroup($query);
        }


        $query->orderBy("data_lancamento", "ASC");
        $pesos = $query->all();

        if(!empty($pesos)){
            $pesos = HistoricoPeso::calculaDiferenca($pesos);
            $pesos = HistoricoPeso::calculaImcLote($pesos);
            $pesos = HistoricoPeso::calculaDiferencaImc($pesos);
        }

        return $pesos;
    }

    /**
     * realiza a busca por um período específico, com data inicial e final
     * exemplo de uso: quando a checkbox "não consolidado" estiver checada
     * @param Object $query query construida até o momento da chamada do método
     * @return mixed
     */
    public function searchByInterval($query)
    {
        if (strpos($this->data_inicial, "/") > 0) {
            $this->data_inicial = DateHelper::toAmerican($this->data_inicial);
        }

        if (strpos($this->data_final, "/") > 0) {
            $this->data_final = DateHelper::toAmerican($this->data_final);
        }

        // grid filtering conditions
        $query->andWhere(['>=', 'data_lancamento', $this->data_inicial]);
        $query->andWhere(['<=', 'data_lancamento', $this->data_final]);
    }

    /**
     * realiza a busca agrupando por mês
     * deste modo, será mostrado uma pesagem por mês, dos últimos 12 mêses
     * exemplo de uso: quando a checkbox "consolidado" estiver checada
     * @param Object $query $query construida até o momento da chamada do método 
     * @return mixed
     */
    public function searchGroup($query)
    {
        $this->data_inicial = DateHelper::calculatePast(365,date("Y-m-d"));
        $this->data_final = date("Y-m-d");
        $query->andWhere(['>=', 'data_lancamento', $this->data_inicial]);
        $query->andWhere(['<=', 'data_lancamento', $this->data_final]);
        $query->groupBy("MONTH(data_lancamento)");
    }
}
