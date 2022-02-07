<?php

namespace api\collectors\auth;

use ddruganov\Yii2ApiEssentials\collectors\AbstractDataCollector;
use Yii;

final class CurrentUserCollector extends AbstractDataCollector
{
    protected function internalRun(): array
    {
        /** @var \api\models\user\User */
        $user = Yii::$app->get('auth')->getCurrentUser();

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName()
        ];
    }
}
