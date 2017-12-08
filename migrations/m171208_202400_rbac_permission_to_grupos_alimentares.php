<?php

use yii\db\Migration;

/**
 * Class m171208_202400_rbac_permission_to_grupos_alimentares
 */
class m171208_202400_rbac_permission_to_grupos_alimentares extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageFoodGroup" permission
        $manageFoodGroup = $auth->createPermission('manageFoodGroup');
        $manageFoodGroup->description = 'Gerenciar grupos de usuários';
        $auth->add($manageFoodGroup);

        // add "admin" role and give this role the "manageUsers" permission
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $manageFoodGroup);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
