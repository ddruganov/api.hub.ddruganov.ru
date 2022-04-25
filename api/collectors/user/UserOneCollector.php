<?php

namespace api\collectors\user;

use api\models\user\User;
use ddruganov\Yii2ApiAuth\collectors\user\UserOneCollector as BaseUserOneCollector;
use ddruganov\Yii2ApiAuth\models\rbac\UserHasRole;
use ddruganov\Yii2ApiEssentials\ExecutionResult;

final class UserOneCollector extends BaseUserOneCollector
{
    protected function _run(): ExecutionResult
    {
        $user = User::findOne($this->id);

        return ExecutionResult::success([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'isBanned' => $user->isBanned(),
            'roleIds' => UserHasRole::find()
                ->select(['role_id'])
                ->byUserId($user->getId())
                ->asArray()
                ->column()
        ]);
    }
}
