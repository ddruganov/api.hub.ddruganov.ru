<?php

namespace api\forms\user;

use api\models\user\User;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\AbstractForm;

final class DeleteForm extends AbstractForm
{
    public int $id;

    public function rules()
    {
        return [
            [['id'], 'exist', 'targetClass' => User::class, 'message' => 'Такого пользователя не существует'],
        ];
    }

    protected function _run(): ExecutionResult
    {
        $model = User::findOne($this->id);
        if ($model->delete() === false) {
            return ExecutionResult::exception('Ошибка удаления пользователя');
        }

        return ExecutionResult::success();
    }
}
