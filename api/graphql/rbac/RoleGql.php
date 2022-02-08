<?php

namespace api\graphql\rbac;

use api\graphql\GraphqlTypes;
use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use ddruganov\Yii2ApiAuth\models\rbac\Role;
use ddruganov\Yii2ApiAuth\models\rbac\RoleHasPermission;
use GraphQL\Type\Definition\ObjectType;

final class RoleGql extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => fn () => [
                'id' => [
                    'type' => GraphqlTypes::int()
                ],
                'name' => [
                    'type' => GraphqlTypes::string(),
                ],
                'description' => [
                    'type' => GraphqlTypes::string(),
                ],
                'permissions' => [
                    'type' => GraphqlTypes::listOf(GraphqlTypes::permissionType()),
                    'resolve' => function (Role $role) {
                        return Permission::find()
                            ->innerJoin(RoleHasPermission::tableName(), 'role_has_permission.permission_id = permission.id')
                            ->where([
                                'role_has_permission.role_id' => $role->getId()
                            ])
                            ->orderBy(['permission.id' => SORT_ASC])
                            ->all();
                    }
                ]
            ]
        ];

        parent::__construct($config);
    }
}
