<?php

use yii\db\Migration;

/**
 * Migration criando tabela historico_peso
 * Essa tabela tem como objetivo guardar o histórico de peso dos usuários
 */
class m171127_232141_create_table_historico_peso extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        //Criar migration de HistoricoPeso com id, usuario_id, data e peso
        $this->createTable('historico_peso', [
            'id' => $this->primaryKey(),
            'usuario_id' => $this->integer(),
            'data_lancamento' => $this->date(),
            'peso' => $this->decimal(5,2)
        ]);

        $this->addForeignKey('fk_historico_user', 'historico_peso', 'usuario_id', 'user', 'id', 'CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('fk_historico_user', 'historico_peso');
        $this->dropTable('historico_peso');
    }
}