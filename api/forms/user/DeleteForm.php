<?php

namespace api\forms\user;

use api\models\user\User;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\models\AbstractApiModel;

class DeleteForm extends AbstractApiModel
{
    public int $id;

    public function rules()
    {
        return [
            [['id'], 'exist', 'targetClass' => User::class, 'message' => 'Такого пользователя не существует'],
        ];
    }

    public function run(): ExecutionResult
    {
        if (!$this->validate()) {
            return ExecutionResult::failure($this->getFirstErrors());
        }

        $model = User::findOne($this->id);
        if ($model->delete() === false) {
            return ExecutionResult::exception('Ошибка удаления пользователя');
        }

        return ExecutionResult::success();
    }
}
