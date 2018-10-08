<?php
namespace tests\models;

use app\models\User;
use app\models\UsuarioFactory;
use app\models\Homem;
use app\models\Mulher;
use app\components\FormatterHelper;
use yii\base\Exception;

class UserFactoryTest extends \Codeception\Test\Unit
{
    public function testMenUser() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 

        $createdObjectLower = $factory->createUser('m');
        $verifyObjectLower = ($createdObject instanceof Homem); 

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals(true, $verifyObjectLower);
    }

    public function testWomenUser() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('F');
        $verifyObject = ($createdObject instanceof Mulher); 

        $createdObjectLower = $factory->createUser('f');
        $verifyObjectLower = ($createdObject instanceof Mulher); 

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals(true, $verifyObjectLower);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidUser() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('A');
        $verifyObject = ($createdObject instanceof Homem); 
    }

    public function testMenSedentary() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->nivelAtividade = User::COD_SEDENTARIO;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.0', $createdObject->caf);
    }

    public function testMenLight() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->nivelAtividade = User::COD_LEVE;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.11', $createdObject->caf);
    }

    public function testMenModerated() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->nivelAtividade = User::COD_MODERADO;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.25', $createdObject->caf);
    }

    public function testMenIntense() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->nivelAtividade = User::COD_INTENSO;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.48', $createdObject->caf);
    }

    public function testWomenSedentary() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('F');
        $verifyObject = ($createdObject instanceof Mulher); 
        $createdObject->nivelAtividade = User::COD_SEDENTARIO;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.0', $createdObject->caf);
    }

    public function testWomenLight() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('F');
        $verifyObject = ($createdObject instanceof Mulher); 
        $createdObject->nivelAtividade = User::COD_LEVE;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.12', $createdObject->caf);
    }

    public function testWomenModerated() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('F');
        $verifyObject = ($createdObject instanceof Mulher); 
        $createdObject->nivelAtividade = User::COD_MODERADO;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.27', $createdObject->caf);
    }

    public function testWomenIntense() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('F');
        $verifyObject = ($createdObject instanceof Mulher); 
        $createdObject->nivelAtividade = User::COD_INTENSO;

        $createdObject->atribuiCaf();

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('1.45', $createdObject->caf);
    }

    public function testMenEer() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->nivelAtividade = User::COD_LEVE;
        $createdObject->idade = 23;
        $createdObject->peso = 62.5;
        $createdObject->altura = 1.65;
        $createdObject->atribuiCaf();

        $createdObject->calculaEer();
        $eer = FormatterHelper::formatBrazilian($createdObject->eer);

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('2.534,84', $eer);
    }

    public function testWomenEer() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('F');
        $verifyObject = ($createdObject instanceof Mulher); 
        $createdObject->nivelAtividade = User::COD_LEVE;
        $createdObject->idade = 23;
        $createdObject->peso = 62.5;
        $createdObject->altura = 1.65;
        $createdObject->atribuiCaf();

        $createdObject->calculaEer();
        $eer = FormatterHelper::formatBrazilian($createdObject->eer);

        $this->assertEquals(true, $verifyObject);
        $this->assertEquals('2.191,92', $eer);
    }

    /**
     * @expectedException Exception
     */
    public function testEerWithInvalidAge() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->nivelAtividade = User::COD_LEVE;
        $createdObject->idade = '-50';
        $createdObject->peso = 62.5;
        $createdObject->altura = 1.65;
        $createdObject->atribuiCaf();

        $createdObject->calculaEer();
        $eer = FormatterHelper::formatBrazilian($createdObject->eer);
    }

    /**
     * @expectedException Exception
     */
    public function testEerWithInvalidCaf() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->caf = '-5';
        $createdObject->idade = '50';
        $createdObject->peso = 62.5;
        $createdObject->altura = 1.65;

        $createdObject->calculaEer();
        $eer = FormatterHelper::formatBrazilian($createdObject->eer);
    }

    /**
     * @expectedException Exception
     */
    public function testEerWithInvalidWeight() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->caf = '-5';
        $createdObject->idade = '50';
        $createdObject->peso = '-62.5';
        $createdObject->altura = 1.65;

        $createdObject->calculaEer();
        $eer = FormatterHelper::formatBrazilian($createdObject->eer);
    }

    /**
     * @expectedException Exception
     */
    public function testEerWithInvalidHeight() {
        $factory = new UsuarioFactory();

        $createdObject = $factory->createUser('M');
        $verifyObject = ($createdObject instanceof Homem); 
        $createdObject->caf = '-5';
        $createdObject->idade = '50';
        $createdObject->peso = '62.5';
        $createdObject->altura = '-1.65';

        $createdObject->calculaEer();
        $eer = FormatterHelper::formatBrazilian($createdObject->eer);
    }

}
