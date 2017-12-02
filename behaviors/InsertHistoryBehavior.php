<?php
namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\models\HistoricoPeso;

/**
 * classe responsável por realizar inserção de um histórico de peso quando o usuário for criado ou atualizado no sistema
 */
class InsertHistoryBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'insertHistory',
            ActiveRecord::EVENT_AFTER_UPDATE => 'insertHistory',
        ];
    }

    public function insertHistory($event)
    {
        date_default_timezone_set('America/Sao_Paulo');
       	$model = $this->owner;
        $historico = new HistoricoPeso();
        $historico->usuario_id = $model->id;
        $historico->data_lancamento = date("Y-m-d");
        $historico->peso = $model->peso;
        $historico->save();
    }
}