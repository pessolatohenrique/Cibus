<?php

use yii\db\Migration;

/**
 * Class m171210_133851_create_table_planilhas
 */
class m171210_133851_create_table_planilhas extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('planilhas', [
            'id' => $this->primaryKey(),
            'arquivo' => $this->string()->notNull(),
            'descricao' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),      
        ]);

        $this->addForeignKey('fk_planilha_usuario', 'planilhas', 'user_id', 'user', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_planilha_usuario', 'planilhas');
        $this->dropTable("planilhas");
    }
}
