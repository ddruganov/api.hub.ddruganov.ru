<?php

namespace api\collectors\auth;

use ddruganov\Yii2ApiAuth\components\AuthComponentInterface;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;
use Yii;

final class CurrentUserCollector extends Form
{
    protected function _run(): ExecutionResult
    {
        /** @var \api\models\user\User */
        $user = Yii::$app->get(AuthComponentInterface::class)->getCurrentUser();

        return ExecutionResult::success([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName()
        ]);
    }
}
