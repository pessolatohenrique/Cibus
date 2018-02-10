<?php

use yii\db\Migration;

/**
 * Class m180210_160624_rbac_permission_to_dieta
 */
class m180210_160624_rbac_permission_to_dieta extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageDieta" permission
        $manageDiet = $auth->createPermission('manageDiet');
        $manageDiet->description = 'Gerenciar Refeições';
        $auth->add($manageDiet);

        // add "admin" role and give this role the "manageDiet" permission
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $manageDiet);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
