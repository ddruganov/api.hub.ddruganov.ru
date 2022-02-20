<?php

namespace api\graphql\user;

use api\graphql\GraphqlTypes;
use api\models\user\User;
use ddruganov\Yii2ApiAuth\models\rbac\Role;
use ddruganov\Yii2ApiAuth\models\rbac\UserHasRole;
use GraphQL\Type\Definition\ObjectType;
use yii\db\Query;

final class UserGql extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => fn () => [
                'id' => [
                    'type' => GraphqlTypes::int()
                ],
                'email' => [
                    'type' => GraphqlTypes::string(),
                ],
                'name' => [
                    'type' => GraphqlTypes::string(),
                ],
                'isBanned' => [
                    'type' => GraphqlTypes::boolean(),
                    'resolve' => fn (User $user) => $user->isBanned()
                ],
                'roles' => [
                    'type' => GraphqlTypes::listOf(GraphqlTypes::roleType()),
                    'resolve' => function (User $user) {
                        return Role::find()
                            ->innerJoin(UserHasRole::tableName(), 'user_has_role.role_id = role.id')
                            ->where([
                                'user_has_role.user_id' => $user->getId()
                            ])
                            ->orderBy(['role.id' => SORT_ASC])
                            ->all();
                    }
                ],
                'roleIds' => [
                    'type' => GraphqlTypes::listOf(GraphqlTypes::int()),
                    'resolve' => function (User $user) {
                        return (new Query())
                            ->select(['role_id'])
                            ->from(UserHasRole::tableName())
                            ->where([
                                'user_id' => $user->getId()
                            ])
                            ->column();
                    }
                ]
            ]
        ];

        parent::__construct($config);
    }
}
