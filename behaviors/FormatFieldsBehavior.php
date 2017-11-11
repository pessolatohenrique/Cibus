<?php
namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\components\DateHelper;
use app\components\FormatterHelper;

class FormatFieldsBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'formatFields',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'formatFields'
        ];
    }

    public function formatFields($event)
    {
    	$formatter = Yii::$app->formatter;
       	$model = $this->owner;
       	$model->data_nascimento = DateHelper::toAmerican($model->data_nascimento);
       	$model->peso = FormatterHelper::formatDecimal($model->peso);
       	$model->altura = FormatterHelper::formatDecimal($model->altura);
    }
}