<?php

use yii\db\Migration;

class m171105_183611_add_field_to_table_user extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn("user","nome_completo",$this->string(255));
        $this->addColumn("user","data_nascimento",$this->date());
        $this->addColumn("user","sexo",$this->char(1));
        $this->addColumn("user","altura",$this->float(2));
        $this->addColumn("user","peso",$this->float(2));
        $this->addColumn("user","nivelAtividade",$this->char(1));
        $this->addColumn("user","aceitaTermos",$this->boolean());
        $this->addColumn("user","role",$this->string(10));
    }

    public function down()
    {
        $this->dropColumn("user","nome_completo");
        $this->dropColumn("user","data_nascimento");
        $this->dropColumn("user","sexo");
        $this->dropColumn("user","altura");
        $this->dropColumn("user","peso");
        $this->dropColumn("user","nivelAtividade");
        $this->dropColumn("user","aceitaTermos");
        $this->dropColumn("user","role");
    }
}
