<?php

namespace api\forms\auth;

use ddruganov\Yii2ApiAuth\models\App;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\AbstractForm;
use Yii;

final class LoginIntoForm extends AbstractForm
{
    public string $appId;

    public function rules()
    {
        return [
            [['appId'], 'exist', 'targetClass' => App::class, 'targetAttribute' => ['appId' => 'id']]
        ];
    }

    protected function _run(): ExecutionResult
    {
        $auth = Yii::$app->get('auth');

        return $auth->login($auth->getCurrentUser(), $this->getApp());
    }

    private function getApp()
    {
        return App::findOne($this->appId);
    }
}
