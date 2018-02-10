<?php

use yii\db\Migration;

/**
 * Class m180210_154120_create_table_dietas
 */
class m180210_154120_create_table_dietas extends Migration
{
    public function up()
    {
        $this->createTable('dietas', [
            'id' => $this->primaryKey(),
            'valor_dieta' => $this->integer(4)->notNull(),
            'descricao' => $this->string(255),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),      
        ]);
    }

    public function down()
    {
        $this->dropTable('dietas');
    }
}
