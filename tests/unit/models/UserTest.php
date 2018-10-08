<?php
namespace tests\models;
use app\models\User;
use app\components\FormatterHelper;
use yii\base\Exception;

class UserTest extends \Codeception\Test\Unit
{
    public function testValidImc()
    {
        $model = new User();
        $model->peso = 62.50;
        $model->altura = 1.65;

        $model->calculaImc();

        $imc = FormatterHelper::formatBrazilian($model->imc);

        $this->assertEquals('22,96', $imc);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidWeight()
    {
        $model = new User();
        $model->peso = '-62.50';
        $model->altura = 1.65;

        $model->calculaImc();

        $imc = FormatterHelper::formatBrazilian($model->imc);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidHeight() {
        $model = new User();
        $model->peso = '62.50';
        $model->altura = '-1.65';

        $model->calculaImc();

        $imc = FormatterHelper::formatBrazilian($model->imc);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidWeightAndHeight() {
        $model = new User();
        $model->peso = '62.50';
        $model->altura = '-1.65';

        $model->calculaImc();

        $imc = FormatterHelper::formatBrazilian($model->imc);
    }

    public function testImcLessThanSixteen() {
        $model = new User();
        $model->imc = 15;

        $model->classificaImc();

        $this->assertEquals('Desnutrição grau 3', $model->classificacao_imc);
    }

    public function testImcEqualsToSixteen() {
        $model = new User();
        $model->imc = 16;

        $model->classificaImc();

        $this->assertEquals('Desnutrição grau 2', $model->classificacao_imc);
    }

    public function testImcEqualsToSixteenDotEight() {
        $model = new User();
        $model->imc = 16.8;

        $model->classificaImc();

        $this->assertEquals('Desnutrição grau 2', $model->classificacao_imc);
    }

    public function testImcEqualsToSeventeenDotNine() {
        $model = new User();
        $model->imc = 17.9;

        $model->classificaImc();

        $this->assertEquals('Desnutrição grau 2', $model->classificacao_imc);
    }

    public function testImcEqualsToEighteen() {
        $model = new User();
        $model->imc = 18;

        $model->classificaImc();

        $this->assertEquals('Desnutrição grau 1', $model->classificacao_imc);
    }

    public function testImcEqualsToEighteenDotTwo() {
        $model = new User();
        $model->imc = 18.2;

        $model->classificaImc();

        $this->assertEquals('Desnutrição grau 1', $model->classificacao_imc);
    }

    public function testImcEqualsToEighteenDotFour() {
        $model = new User();
        $model->imc = 18.4;

        $model->classificaImc();

        $this->assertEquals('Desnutrição grau 1', $model->classificacao_imc);
    }

    public function testImcEqualsToEighteenDotFive() {
        $model = new User();
        $model->imc = 18.5;

        $model->classificaImc();

        $this->assertEquals('Eutrofia', $model->classificacao_imc);
    }

    public function testImcEqualsToNineteenDotTwo() {
        $model = new User();
        $model->imc = 19.2;

        $model->classificaImc();

        $this->assertEquals('Eutrofia', $model->classificacao_imc);
    }

    public function testImcEqualsToTwentyFourDotNine() {
        $model = new User();
        $model->imc = 24.9;

        $model->classificaImc();

        $this->assertEquals('Eutrofia', $model->classificacao_imc);
    }

    public function testImcEqualsToTwentyFive() {
        $model = new User();
        $model->imc = 25;

        $model->classificaImc();

        $this->assertEquals('Sobrepeso', $model->classificacao_imc);
    }

    public function testImcEqualsToTwentySixDotSeven() {
        $model = new User();
        $model->imc = 26.9;

        $model->classificaImc();

        $this->assertEquals('Sobrepeso', $model->classificacao_imc);
    }

    public function testImcEqualsToTwentyNineDotNine() {
        $model = new User();
        $model->imc = 29.9;

        $model->classificaImc();

        $this->assertEquals('Sobrepeso', $model->classificacao_imc);
    }

    public function testImcEqualsToThirty() {
        $model = new User();
        $model->imc = 30;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 1', $model->classificacao_imc);
    }

    public function testImcEqualsToThirtyTwo() {
        $model = new User();
        $model->imc = 32;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 1', $model->classificacao_imc);
    }

    public function testImcEqualsToThirtyFourDotNine() {
        $model = new User();
        $model->imc = 34.9;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 1', $model->classificacao_imc);
    }

    public function testImcEqualsToThirtyFive() {
        $model = new User();
        $model->imc = 35;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 2', $model->classificacao_imc);
    }

    public function testImcEqualsToThirtySevenDotFour() {
        $model = new User();
        $model->imc = 37.4;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 2', $model->classificacao_imc);
    }

    public function testImcEqualsToThirtyNineDotNine() {
        $model = new User();
        $model->imc = 39.9;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 2', $model->classificacao_imc);
    }

    public function testImcEqualsToFourty() {
        $model = new User();
        $model->imc = 40;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 3', $model->classificacao_imc);
    }

    public function testImcEqualsToFiftyFive() {
        $model = new User();
        $model->imc = 55;

        $model->classificaImc();

        $this->assertEquals('Obesidade grau 3', $model->classificacao_imc);
    }

    /**
     * @expectedException Exception
     */
    public function testAgeWithInvalidDate() {
        $model = new User();
        $model->data_nascimento = "9999-44-26";

        $model->calculaIdade();
    }

    public function testAgeWithValidDate() {
        $firstUser = new User();
        $firstUser->data_nascimento = "1995-05-26";
        $firstUser->calculaIdade();

        $secondUser = new User();
        $secondUser->data_nascimento = "1984-01-01";
        $secondUser->calculaIdade();

        $thirdUser = new User();
        $thirdUser->data_nascimento = "1990-12-31";
        $thirdUser->calculaIdade();
        
        $this->assertEquals(23, $firstUser->idade);
        $this->assertEquals(34, $secondUser->idade);
        $this->assertEquals(27, $thirdUser->idade);
    }

}
