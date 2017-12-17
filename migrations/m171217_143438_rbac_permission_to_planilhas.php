<?php

use yii\db\Migration;

/**
 * Class m171217_143438_rbac_permission_to_planilhas
 */
class m171217_143438_rbac_permission_to_planilhas extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageFoodGroup" permission
        $manageSheet = $auth->createPermission('manageSheet');
        $manageSheet->description = 'Gerenciar planilhas';
        $auth->add($manageSheet);

        // add "admin" role and give this role the "manageUsers" permission
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $manageSheet);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
