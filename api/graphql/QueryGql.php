<?php

namespace api\graphql;

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
                    'resolve' => function () {
                        return Role::find()->orderBy(['id' => SORT_ASC])->all();
                    }
                ],
                'role' => [
                    'type' => GraphqlTypes::roleType(),
                    'args' => [
                        'id' => GraphqlTypes::nonNull(GraphqlTypes::int()),
                    ],
                    'resolve' => function ($_, $args) {
                        return Role::findOne($args['id']);
                    }
                ],
                'permission' => [
                    'type' => GraphqlTypes::listOf(GraphqlTypes::permissionType()),
                    'resolve' => function () {
                        return Permission::find()->orderBy(['name' => SORT_ASC])->all();
                    }
                ]
            ]
        ];

        parent::__construct($config);
    }
}
