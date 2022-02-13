<?php

namespace api\forms\role;

use ddruganov\Yii2ApiAuth\models\rbac\Role;

class UpdateForm extends CreateForm
{
    public int $id;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['id'], 'exist', 'targetClass' => Role::class, 'message' => 'Такой роли не существует'],
        ]);
    }

    protected function getModel()
    {
        return Role::findOne($this->id);
    }
}
