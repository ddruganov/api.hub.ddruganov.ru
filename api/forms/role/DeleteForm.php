<?php

namespace api\forms\role;

use ddruganov\Yii2ApiAuth\models\rbac\Role;
use ddruganov\Yii2ApiAuth\models\rbac\RoleHasPermission;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;

class DeleteForm extends Form
{
    public int $id;

    public function rules()
    {
        return [
            [['id'], 'exist', 'targetClass' => Role::class, 'message' => 'Такой роли не существует'],
        ];
    }

    protected function _run(): ExecutionResult
    {
        $model = Role::findOne($this->id);
        if ($model->delete() === false) {
            return ExecutionResult::exception('Ошибка удаления роли');
        }

        $bindings = RoleHasPermission::findAll(['role_id' => $model->getId()]);
        foreach ($bindings as $binding) {
            if ($binding->delete() === false) {
                return ExecutionResult::exception('Ошибка удаления привязок к разрешениям');
            }
        }

        return ExecutionResult::success();
    }
}
