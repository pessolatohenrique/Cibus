<?php
namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\components\DateHelper;
use app\components\FormatterHelper;

class CalculateBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'calculate'        
        ];
    }

    public function calculate($event)
    {
       	$model = $this->owner;
        $model->calculaIdade();
        $model->calculaImc();
        $model->classificaImc();
        $model->atribuiCaf();
        $model->calculaEer();
        $model->calculaTmb();
        $model->selecionaDieta();
    }
}