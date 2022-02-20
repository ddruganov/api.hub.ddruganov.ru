<?php

namespace api\components;

use ddruganov\Yii2ApiAuth\components\RbacComponent as BaseRbacComponent;
use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiAuth\models\User;

final class RbacComponent extends BaseRbacComponent
{
    public function canAuthenticate(User $user)
    {
        return $this->checkPermission(Permission::findOne(['name' => 'hub.authenticate']), $user);
    }
}
