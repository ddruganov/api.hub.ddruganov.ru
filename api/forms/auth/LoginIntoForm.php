<?php

namespace api\forms\auth;

use ddruganov\Yii2ApiAuth\models\App;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\models\AbstractApiModel;
use Yii;

final class LoginIntoForm extends AbstractApiModel
{
    public string $appId;

    public function rules()
    {
        return [
            [['appId'], 'exist', 'targetClass' => App::class, 'targetAttribute' => ['appId' => 'id']]
        ];
    }

    public function run(): ExecutionResult
    {
        if (!$this->validate()) {
            return ExecutionResult::failure($this->getFirstErrors());
        }

        $auth = Yii::$app->get('auth');

        return $auth->login($auth->getCurrentUser(), $this->getApp());
    }

    private function getApp()
    {
        return App::findOne($this->appId);
    }
}
