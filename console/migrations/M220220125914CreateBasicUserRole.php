<?php

namespace console\migrations;

use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiEssentials\DateHelper;
use Yii;
use yii\db\Migration;

class M220220125914CreateBasicUserRole extends Migration
{
    private const ROLE_NAME = 'user';

    public function safeUp()
    {
        $this->insert('rbac.role', [
            'name' => self::ROLE_NAME,
            'description' => 'Пользователь',
            'created_at' => DateHelper::now(),
            'updated_at' => DateHelper::now(),
        ]);
        $roleId = Yii::$app->getDb()->getLastInsertID();

        $this->batchInsert('rbac.role_has_permission', [
            'role_id', 'permission_id'
        ], [
            [$roleId, Permission::find()->select(['id'])->where(['name' => 'hub.authenticate'])]
        ]);
    }

    public function safeDown()
    {
        $this->delete('rbac.role', ['name' => self::ROLE_NAME]);

        return true;
    }
}
