<?php

namespace api\forms\permission;

use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiAuth\models\rbac\RoleHasPermission;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\models\AbstractApiModel;

class DeleteForm extends AbstractApiModel
{
    public int $id;

    public function rules()
    {
        return [
            [['id'], 'exist', 'targetClass' => Permission::class, 'message' => 'Такого разрешения не существует'],
        ];
    }

    public function run(): ExecutionResult
    {
        if (!$this->validate()) {
            return ExecutionResult::failure($this->getFirstErrors());
        }

        $model = Permission::findOne($this->id);
        if ($model->delete() === false) {
            return ExecutionResult::exception('Ошибка удаления разрешения');
        }

        $bindings = RoleHasPermission::findAll(['permission_id' => $model->getId()]);
        foreach ($bindings as $binding) {
            if ($binding->delete() === false) {
                return ExecutionResult::exception('Ошибка удаления ролей, привязанным к разрешению');
            }
        }

        return ExecutionResult::success();
    }
}
