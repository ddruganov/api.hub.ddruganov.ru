<?php

namespace api\components\auth;

use api\models\user\User;
use ddruganov\Yii2ApiAuth\components\AuthComponent as BaseAuthComponent;

final class AuthComponent extends BaseAuthComponent
{
    public function getCurrentUser(): ?User
    {
        return User::findOne($this->getPayloadValue('uid'));
    }
}
