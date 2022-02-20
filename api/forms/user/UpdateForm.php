<?php

namespace api\forms\user;

use api\forms\user\BaseForm;
use api\models\user\User;
use yii\base\Model;

final class UpdateForm extends BaseForm
{
    public int $id;
    public ?bool $isBanned = null;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['id'], 'exist', 'targetClass' => User::class, 'message' => 'Такого пользователя не существует'],
            [['isBanned'], 'boolean']
        ]);
    }

    protected function getModel()
    {
        return User::findOne($this->id);
    }

    protected function setCustomAttributes(Model $model)
    {
        $model->setAttributes([
            'is_banned' => $this->isBanned
        ]);
    }
}
