<?php

use yii\db\Migration;

/**
 * Class m180210_140408_rbac_permission_to_refeicoes
 */
class m180210_140408_rbac_permission_to_refeicoes extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageMeal" permission
        $manageMeal = $auth->createPermission('manageMeal');
        $manageMeal->description = 'Gerenciar Refeições';
        $auth->add($manageMeal);

        // add "admin" role and give this role the "manageMeal" permission
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $manageMeal);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
