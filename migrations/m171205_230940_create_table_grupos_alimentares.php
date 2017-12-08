<?php

use yii\db\Migration;

/**
 * Class m171205_230940_create_table_grupos_alimentares
 */
class m171205_230940_create_table_grupos_alimentares extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('grupos_alimentares', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string()->notNull(),
            'valor_porcao' => $this->float()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()        
        ]);
    }

    public function down()
    {
        $this->dropTable("grupos_alimentares");
    }
}
