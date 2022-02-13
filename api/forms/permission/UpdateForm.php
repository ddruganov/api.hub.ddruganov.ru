<?php

namespace api\forms\permission;

use ddruganov\Yii2ApiAuth\models\rbac\Permission;

class UpdateForm extends CreateForm
{
    public int $id;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['id'], 'exist', 'targetClass' => Permission::class, 'message' => 'Такого разрешения не существует'],
        ]);
    }

    protected function getModel()
    {
        return Permission::findOne($this->id);
    }
}
