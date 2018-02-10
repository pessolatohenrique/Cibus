<?php

use yii\db\Migration;

/**
 * Class m180210_132229_create_table_refeicoes
 */
class m180210_132229_create_table_refeicoes extends Migration
{
    public function up()
    {
        $this->createTable('refeicoes', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),      
        ]);
    }

    public function down()
    {
        $this->dropTable('refeicoes');
    }
}
