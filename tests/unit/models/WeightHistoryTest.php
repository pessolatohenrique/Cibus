<?php
namespace tests\models;

use Codeception\Util\Stub;
use app\models\LoginForm;
use app\models\HistoricoPeso;
use app\models\HistoricoPesoSearch;
use app\components\FormatterHelper;
use yii\base\Exception;

class WeightHistoryTest extends \Codeception\Test\Unit
{
    protected $filter_search;
    protected $filter_invalid;

    protected function _before()
    {
        $this->loginUser();
        $this->insertHistories();
        $this->buildFilters();
    }

    /**
     * constrói os filtros que serão utilizados durante o teste
     * @return void
     */
    protected function buildFilters() 
    {
        $this->filter_search = array ('HistoricoPesoSearch' =>
            array(
                'data_inicial' => '01/05/2018',
                'data_final' => '30/05/2018',
                'consolidado' => '0'
            )
        );

        $this->filter_invalid = array ('HistoricoPesoSearch' =>
            array(
                'data_inicial' => '01/01/1970',
                'data_final' => '31/01/1970',
                'consolidado' => '0'
            )
        );
    }

    /**
     * realiza o login do usuário
     * o objetivo é ser possível utilizar testes que usem essa informação
     * @return void
     */
    protected function loginUser() 
    {
        $model = new LoginForm();
        $model->username = "pessolatohenrique";
        $model->password = "admin";
        $model->rememberMe = '1';
        $model->login();
    }

    /**
     * realiza a inserção de históricos
     * o objetivo é gerar base durante os testes
     * @return void
     */
    protected function insertHistories() 
    {
        $historico_01 = new HistoricoPeso();
        $historico_01->data_lancamento = '2018-05-01';
        $historico_01->peso = '62.5';
        $historico_01->save();

        $historico_02 = new HistoricoPeso();
        $historico_02->data_lancamento = '2018-05-08';
        $historico_02->peso = '62';
        $historico_02->save();

        $historico_03 = new HistoricoPeso();
        $historico_03->data_lancamento = '2018-05-15';
        $historico_03->peso = '61.5';
        $historico_03->save();

        $historico_04 = new HistoricoPeso();
        $historico_04->data_lancamento = '2018-05-22';
        $historico_04->peso = '62';
        $historico_04->save();
    }

    public function testHistorySearch() 
    {
        $searchModel = new HistoricoPesoSearch();
        $result = $searchModel->search($this->filter_search);

        $this->assertEquals(4, count($result));
        $this->assertEquals('62.50', $result[0]->peso);
        $this->assertEquals('01/05/2018', $result[0]->data_lancamento);
        $this->assertEquals('62.00', $result[3]->peso);
        $this->assertEquals('22/05/2018', $result[3]->data_lancamento);
    }

    public function testHistorySearchWithInvalidDate() 
    {
        $searchModel = new HistoricoPesoSearch();
        $result = $searchModel->search($this->filter_invalid);

        $this->assertEquals(0, count($result));
    }

    public function testHistoryDifferences() {
        $searchModel = new HistoricoPesoSearch();
        $result = $searchModel->search($this->filter_search);

        $this->assertEquals('0', $result[0]->diferenca);
        $this->assertEquals('0.5', $result[1]->diferenca);
        $this->assertEquals('0.5', $result[2]->diferenca);
        $this->assertEquals('-0.5', $result[3]->diferenca);
    }

    public function testHistoryImcDifferences() {
        $searchModel = new HistoricoPesoSearch();
        $result = $searchModel->search($this->filter_search);

        $result[1]->diferenca_imc = round($result[1]->diferenca_imc, 2);
        $result[2]->diferenca_imc = round($result[2]->diferenca_imc, 2);
        $result[3]->diferenca_imc = round($result[3]->diferenca_imc, 2);

        $this->assertEquals('0', $result[0]->diferenca_imc);
        $this->assertEquals('0.18', $result[1]->diferenca_imc, 1);
        $this->assertEquals('0.18', $result[2]->diferenca_imc);
        $this->assertEquals('-0.18', $result[3]->diferenca_imc);
    }
}
