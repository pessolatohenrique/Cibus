<?php

use yii\db\Migration;

/**
 * Class m180703_170532_add_field_access_token_to_table_user
 */
class m180703_170532_add_field_access_token_to_table_user extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn("user","access_token",$this->string(255));
    }

    public function down()
    {
        $this->dropColumn("user","access_token");
    }
}
