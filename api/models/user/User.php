<?php

namespace api\models\user;

use ddruganov\Yii2ApiAuth\models\User as BaseUser;

/**
 * @property bool $is_banned
 */
final class User extends BaseUser
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['is_banned'], 'boolean']
        ]);
    }

    public function isBanned()
    {
        return $this->is_banned;
    }
}
