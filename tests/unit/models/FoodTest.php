<?php
namespace tests\models;

use Codeception\Util\Stub;
use app\models\Alimento;
use app\components\FormatterHelper;
use yii\base\Exception;

class FoodTest extends \Codeception\Test\Unit
{
    protected $food_search;

    protected function _before()
    {
        $this->findFood();
    }

    /**
     * realiza a busca do alimento que será utilizado durante os testes
     * @return void
     */
    protected function findFood() 
    {
        $this->food_search = Alimento::find()->where(['id' => 1965])->one();
    }

    public function testCaloriesCalculate() 
    {
        $food = $this->food_search;
        $firstQuantity = $food->calculaCalorias(1);
        $this->assertEquals(135, $food->total_calorias);

        $secondQuantity = $food->calculaCalorias(2);
        $this->assertEquals(270, $food->total_calorias);
        
        $thirdQuantity = $food->calculaCalorias(3);
        $this->assertEquals(405, $food->total_calorias);
    }

    /**
     * @expectedException Exception
     */
    public function testZeroQuantity() {
        $food = $this->food_search;
        $firstQuantity = $food->calculaCalorias(0);
    }

    /**
     * @expectedException Exception
     */
    public function testNegativeQuantity() {
        $food = $this->food_search;
        $firstQuantity = $food->calculaCalorias('-1');
        $firstQuantity = $food->calculaCalorias('-5');
    }
}
