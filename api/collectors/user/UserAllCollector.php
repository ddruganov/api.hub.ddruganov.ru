<?php

namespace api\collectors\user;

use api\models\user\User;
use ddruganov\Yii2ApiAuth\collectors\user\UserAllCollector as BaseUserAllCollector;
use ddruganov\Yii2ApiEssentials\ExecutionResult;

final class UserAllCollector extends BaseUserAllCollector
{
    protected function _run(): ExecutionResult
    {
        $query = User::find()
            ->newestFirst()
            ->limit($this->limit)
            ->page($this->page);

        return ExecutionResult::success([
            'totalPageCount' => (clone $query)->getPageCount(),
            'users' => array_map(
                fn (User $user) => [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'name' => $user->getName(),
                    'isBanned' => $user->isBanned(),
                    'createdAt' => $user->getCreatedAt(),
                ],
                (clone $query)->all()
            )
        ]);
    }
}
