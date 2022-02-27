<?php

namespace api\forms\permission;

use ddruganov\Yii2ApiAuth\models\App;
use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\models\AbstractApiModel;

class CreateForm extends AbstractApiModel
{
    public ?string $name = null;
    public ?string $description = null;
    public ?string $appId = null;

    public function rules()
    {
        return [
            [['name', 'description', 'appId'], 'required', 'message' => 'Поле "{attribute}" обязательно для заполнения'],
            [['name', 'description', 'appId'], 'string'],
            [['appId'], 'exist', 'targetClass' => App::class, 'targetAttribute' => ['appId' => 'id']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
            'appId' => 'Приложение'
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
            'description' => $this->description,
            'app_id' => $this->appId
        ]);
        if (!$model->save()) {
            return ExecutionResult::failure($model->getFirstErrors());
        }

        return ExecutionResult::success();
    }

    protected function getModel()
    {
        return new Permission();
    }
}
