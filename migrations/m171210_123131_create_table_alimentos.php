<?php

use yii\db\Migration;

/**
 * Class m171210_123131_create_table_alimentos
 */
class m171210_123131_create_table_alimentos extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('alimentos', [
            'id' => $this->primaryKey(),
            'grupo_id' => $this->integer()->notNull(),
            'descricao' => $this->string()->notNull(),
            'medida_caseira' => $this->string()->notNull(),
            'calorias' => $this->float()->notNull()        
        ]);

        $this->addForeignKey('fk_alimentos_grupo', 'alimentos', 'grupo_id', 'grupos_alimentares', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_alimentos_grupo', 'alimentos');
        $this->dropTable("alimentos");
    }
}
