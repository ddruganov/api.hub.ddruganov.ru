<?php

namespace api\graphql\rbac;

use api\graphql\GraphqlTypes;
use ddruganov\Yii2ApiAuth\models\rbac\Permission;
use GraphQL\Type\Definition\ObjectType;

final class PermissionGql extends ObjectType
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
                'appId' => [
                    'type' => GraphqlTypes::string(),
                    'resolve' => fn (Permission $permission) => $permission->getAppId()
                ]
            ]
        ];

        parent::__construct($config);
    }
}
