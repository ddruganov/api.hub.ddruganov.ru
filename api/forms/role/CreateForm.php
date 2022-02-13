<?php

namespace api\forms\role;

use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiAuth\models\rbac\Role;
use ddruganov\Yii2ApiAuth\models\rbac\RoleHasPermission;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\models\AbstractApiModel;

class CreateForm extends AbstractApiModel
{
    public ?string $name = null;
    public ?string $description = null;
    public ?array $permissionIds = null;

    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'message' => 'Поле "{attribute}" обязательно для заполнения'],
            [['name', 'description'], 'string'],
            [['permissionIds'], 'each', 'rule' => ['integer']],
            [['permissionIds'], 'each', 'rule' => ['exist', 'targetClass' => Permission::class, 'targetAttribute' => ['permissionIds' => 'id']]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание'
        ];
    }

    public function run(): ExecutionResult
    {
        if (!$this->validate()) {
            return ExecutionResult::failure($this->getFirstErrors());
        }

        $model = $this->getModel();
        $model->setAttributes([
            'name' => $this->name,
            'description' => $this->description
        ]);
        if (!$model->save()) {
            return ExecutionResult::failure($model->getFirstErrors());
        }

        $bindings = RoleHasPermission::findAll(['role_id' => $model->getId()]);
        foreach ($bindings as $binding) {
            if ($binding->delete() === false) {
                return ExecutionResult::failure(['permissionIds' => 'Ошибка удаления привязок к разрешениям']);
            }
        }

        foreach ($this->permissionIds as $permissionId) {
            $binding = new RoleHasPermission([
                'role_id' => $model->getId(),
                'permission_id' => $permissionId
            ]);
            if (!$binding->save()) {
                return ExecutionResult::failure(['permissionIds' => 'Ошибка привязки разрешений']);
            }
        }

        return ExecutionResult::success();
    }

    protected function getModel()
    {
        return new Role();
    }
}
