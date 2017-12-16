<?php

use yii\db\Migration;

/**
 * Class m171216_205745_rbac_permission_to_alimentos
 */
class m171216_205745_rbac_permission_to_alimentos extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageFoodGroup" permission
        $manageFood = $auth->createPermission('manageFood');
        $manageFood->description = 'Gerenciar alimentos';
        $auth->add($manageFood);

        // add "admin" role and give this role the "manageUsers" permission
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $manageFood);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
