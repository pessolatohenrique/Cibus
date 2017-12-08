<?php

use yii\db\Migration;

/**
 * Migration responsável por criar o rbac do sistema
 */
class m171123_221435_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageUsers" permission
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Gerenciar usuários';
        $auth->add($manageUsers);

        // add "food group" permission
        $manageFoodGroup = $auth->createPermission('manageFoodGroup');
        $manageFoodGroup->description = 'Gerenciar grupo de alimentos';
        $auth->add($manageFoodGroup);

        // add "admin" role and give this role the "manageUsers" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $manageFoodGroup);

        $auth->assign($admin, 1);
    }
    
    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
