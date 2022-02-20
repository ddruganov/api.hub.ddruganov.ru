<?php

namespace api\forms\user;

use api\models\user\User;
use ddruganov\Yii2ApiAuth\models\rbac\Role;
use ddruganov\Yii2ApiAuth\models\rbac\UserHasRole;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\models\AbstractApiModel;
use yii\base\Model;

abstract class BaseForm extends AbstractApiModel
{
    public ?string $email = null;
    public ?string $name = null;
    public ?array $roleIds = null;

    public function rules()
    {
        return [
            [['email', 'name', 'roleIds'], 'required', 'message' => 'Поле "{attribute}" обязательно для заполнения'],
            [['email', 'name'], 'string'],
            [['email'], 'email'],
            [['roleIds'], 'each', 'rule' => ['integer']],
            [['roleIds'], 'each', 'rule' => ['exist', 'targetClass' => Role::class, 'targetAttribute' => ['roleIds' => 'id']]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'name' => 'Имя',
            'roleIds' => 'Роли'
        ];
    }

    public function run(): ExecutionResult
    {
        if (!$this->validate()) {
            return ExecutionResult::failure($this->getFirstErrors());
        }
        $model = $this->getModel();
        $model->setAttributes([
            'email' => $this->email,
            'name' => $this->name,
        ]);
        $this->setCustomAttributes($model);
        if (!$model->save()) {
            return ExecutionResult::failure($model->getFirstErrors());
        }

        $bindings = UserHasRole::findAll(['user_id' => $model->getId()]);
        foreach ($bindings as $binding) {
            if ($binding->delete() === false) {
                return ExecutionResult::failure(['roleIds' => 'Ошибка удаления привязок к ролям']);
            }
        }

        foreach ($this->roleIds as $roleId) {
            $binding = new UserHasRole([
                'user_id' => $model->getId(),
                'role_id' => $roleId
            ]);
            if (!$binding->save()) {
                return ExecutionResult::failure(['roleIds' => 'Ошибка привязки ролей']);
            }
        }

        return ExecutionResult::success();
    }

    protected function getModel()
    {
        return new User();
    }

    protected abstract function setCustomAttributes(Model $model);
}
