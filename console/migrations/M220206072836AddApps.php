<?php

namespace console\migrations;

use ddruganov\Yii2ApiAuth\models\rbac\Role;
use ddruganov\Yii2ApiEssentials\DateHelper;
use yii\db\Migration;
use yii\db\Query;

class M220206072836AddApps extends Migration
{
    private function getTableName()
    {
        return 'app.app';
    }

    public function safeUp()
    {
        $this->update($this->getTableName(), [
            'name' => 'Hub',
            'alias' => 'hub',
            'url' => 'http://localhost:3000'
        ], ['is_default' => true]);

        $appConfigs = [
            [
                'name' => 'PAcc',
                'alias' => 'pacc',
                'audience' => 'localhost',
                'url' => 'http://localhost:4000',
                'is_default' => false
            ], [
                'name' => 'LinkToMe',
                'alias' => 'linktome',
                'audience' => 'localhost',
                'url' => 'http://localhost:5000',
                'is_default' => false
            ],
        ];

        foreach ($appConfigs as $appConfig) {
            $this->insert($this->getTableName(), $appConfig);
            $appId = (new Query())->from($this->getTableName())->select(['id'])->where($appConfig)->scalar();

            $this->insert('rbac.permission', [
                'app_id' => $appId,
                'name' => 'authenticate',
                'description' => 'Вход в ' . $appConfig['name'],
                'created_at' => DateHelper::now(),
                'updated_at' => DateHelper::now(),
            ]);
            $permissionId = $this->getDb()->getLastInsertID();

            $this->insert('rbac.role_has_permission', [
                'role_id' => Role::findOne(['name' => 'admin'])->getId(),
                'permission_id' => $permissionId
            ]);
        }
    }

    public function safeDown()
    {
        $this->delete($this->getTableName(), ['is_default' => false]);
        return true;
    }
}
