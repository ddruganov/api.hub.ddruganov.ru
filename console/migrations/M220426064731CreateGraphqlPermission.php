<?php

namespace console\migrations;

use ddruganov\Yii2ApiAuth\models\App;
use ddruganov\Yii2ApiEssentials\DateHelper;
use yii\db\Migration;
use yii\db\Query;

class M220426064731CreateGraphqlPermission extends Migration
{
    public function safeUp()
    {
        $this->insert('rbac.permission', [
            'app_uuid' => App::default()->getUuid(),
            'name' => 'graphql.read',
            'description' => 'Доступ к методам чтения GraphQL',
            'created_at' => DateHelper::now(),
            'updated_at' => DateHelper::now()
        ]);
        $permissionId = $this->getDb()->getLastInsertID();

        $this->insert('rbac.role_has_permission', [
            'role_id' => (new Query())->select(['id'])->from('rbac.role')->where(['name' => 'admin'])->scalar(),
            'permission_id' => $permissionId
        ]);
    }

    public function safeDown()
    {
        $this->delete('rbac.permission', ['name' => 'graphql.read']);
    }
}
