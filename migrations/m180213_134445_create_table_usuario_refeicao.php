<?php

use yii\db\Migration;

/**
 * Class m180213_134445_create_table_usuario_refeicao
 */
class m180213_134445_create_table_usuario_refeicao extends Migration
{
    //Criar migration com os campos: id, usuario_id, refeicao_id, alimento_id, 
    // data_consumo, horario_consumo, quantidade
    public function up()
    {
        $this->createTable('usuario_refeicao', [
            'id' => $this->primaryKey(),
            'usuario_id' => $this->integer(),
            'refeicao_id' => $this->integer(),
            'alimento_id' => $this->integer(),
            'data_consumo' => $this->date(),
            'horario_consumo' => $this->time(),
            'quantidade' => $this->double(5,2),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()      
        ]);

        $this->addForeignKey('fk_usuariorefeicao_usuario_id', 'usuario_refeicao', 'usuario_id', 
            'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_usuariorefeicao_refeicao_id', 'usuario_refeicao', 'refeicao_id', 
            'refeicoes', 'id', 'CASCADE');
        $this->addForeignKey('fk_usuariorefeicao_alimento_id', 'usuario_refeicao', 
            'alimento_id', 'alimentos', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_usuariorefeicao_usuario_id', 'usuario_refeicao');
        $this->dropForeignKey('fk_usuariorefeicao_refeicao_id', 'usuario_refeicao');
        $this->dropForeignKey('fk_usuariorefeicao_alimento_id', 'usuario_refeicao');
        $this->dropTable('usuario_refeicao');
    }
}
