<?php

namespace api\graphql\app;

use api\graphql\GraphqlTypes;
use GraphQL\Type\Definition\ObjectType;

final class AppGql extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => fn () => [
                'id' => [
                    'type' => GraphqlTypes::string()
                ],
                'name' => [
                    'type' => GraphqlTypes::string(),
                ],
                'alias' => [
                    'type' => GraphqlTypes::string()
                ],
                'url' => [
                    'type' => GraphqlTypes::string(),
                ],
                'isDefault' => [
                    'type' => GraphqlTypes::boolean()
                ]
            ]
        ];

        parent::__construct($config);
    }
}
