<?php

namespace api\collectors\auth;

use ddruganov\Yii2ApiAuth\collectors\user\CurrentUserCollector as BaseCurrentUserCollector;
use ddruganov\Yii2ApiAuth\components\AuthComponentInterface;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use Yii;

final class CurrentUserCollector extends BaseCurrentUserCollector
{
    protected function _run(): ExecutionResult
    {
        /** @var \api\models\user\User */
        $user = Yii::$app->get(AuthComponentInterface::class)->getCurrentUser();

        return ExecutionResult::success([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'isBanned' => $user->isBanned()
        ]);
    }
}
