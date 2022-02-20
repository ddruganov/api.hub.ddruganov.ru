<?php

namespace api\graphql;

use api\models\user\User;
use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiAuth\models\rbac\Role;
use GraphQL\Type\Definition\ObjectType;

final class QueryGql extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => fn () => [
                'roles' => [
                    'type' => GraphqlTypes::listOf(GraphqlTypes::roleType()),
                    'resolve' => fn () => Role::find()->orderBy(['id' => SORT_ASC])->all()
                ],
                'role' => [
                    'type' => GraphqlTypes::roleType(),
                    'args' => ['id' => GraphqlTypes::nonNull(GraphqlTypes::int())],
                    'resolve' => fn ($_, $args) => Role::findOne($args['id'])
                ],
                'permissions' => [
                    'type' => GraphqlTypes::listOf(GraphqlTypes::permissionType()),
                    'resolve' => fn () => Permission::find()->orderBy(['name' => SORT_ASC])->all()
                ],
                'permission' => [
                    'type' => GraphqlTypes::permissionType(),
                    'args' => ['id' => GraphqlTypes::nonNull(GraphqlTypes::int())],
                    'resolve' => fn ($_, $args) => Permission::findOne($args['id'])
                ],
                'users' => [
                    'type' => GraphqlTypes::listOf(GraphqlTypes::userType()),
                    'resolve' => fn () => User::find()->orderBy(['id' => SORT_DESC])->all()
                ],
                'user' => [
                    'type' => GraphqlTypes::userType(),
                    'args' => ['id' => GraphqlTypes::nonNull(GraphqlTypes::int())],
                    'resolve' => fn ($_, $args) => User::findOne($args['id'])
                ],
            ]
        ];

        parent::__construct($config);
    }
}
