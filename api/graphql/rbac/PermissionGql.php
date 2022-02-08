<?php

namespace api\graphql\rbac;

use api\graphql\GraphqlTypes;
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
            ]
        ];

        parent::__construct($config);
    }
}
