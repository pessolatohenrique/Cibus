<?php

use yii\db\Migration;

/**
 * Class m180211_013957_create_table_alimento_dieta
 */
class m180211_013957_create_table_alimento_dieta extends Migration
{
    public function up()
    {
        $this->createTable('alimento_dieta', [
            'id' => $this->primaryKey(),
            'alimento_id' => $this->integer(),
            'dieta_id' => $this->integer(),
            'refeicao_id' => $this->integer(),
            'porcao' => $this->string(5),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()      
        ]);

        $this->addForeignKey('fk_dieta_alimento_id', 'alimento_dieta', 'alimento_id', 'alimentos', 'id', 
            'CASCADE');
        $this->addForeignKey('fk_dieta_dieta_id', 'alimento_dieta', 'dieta_id', 'dietas', 'id', 
            'CASCADE');
        $this->addForeignKey('fk_dieta_refeicao_id', 'alimento_dieta', 'refeicao_id', 'refeicoes', 'id', 
            'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_dieta_alimento_id', 'alimento_dieta');
        $this->dropForeignKey('fk_dieta_dieta_id', 'alimento_dieta');
        $this->dropForeignKey('fk_dieta_refeicao_id', 'alimento_dieta');
        $this->dropTable('alimento_dieta');
    }
}
