<?php

namespace api\forms\auth;

use api\forms\user\CreateForm;
use ddruganov\Yii2ApiAuth\models\rbac\Role;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\AbstractForm;

final class SignupForm extends AbstractForm
{
    public ?string $email = null;
    public ?string $name = null;
    public ?string $password = null;

    public function rules()
    {
        return [
            [['email', 'name', 'password'], 'safe']
        ];
    }

    protected function _run(): ExecutionResult
    {
        $userCreationForm = new CreateForm([
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'roleIds' => [Role::find()->select(['id'])->where(['name' => 'user'])->scalar()]
        ]);

        $result = $userCreationForm->run();
        if (!$result->isSuccessful()) {
            return $result;
        }

        return ExecutionResult::success();
    }
}
