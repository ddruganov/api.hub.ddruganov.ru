<?php

namespace api\forms\permission;

use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiAuth\models\rbac\RoleHasPermission;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;

class DeleteForm extends Form
{
    public int $id;

    public function rules()
    {
        return [
            [['id'], 'exist', 'targetClass' => Permission::class, 'message' => 'Такого разрешения не существует'],
        ];
    }

    protected function _run(): ExecutionResult
    {
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
