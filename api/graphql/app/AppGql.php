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
                'uuid' => [
                    'type' => GraphqlTypes::string()
                ],
                'name' => [
                    'type' => GraphqlTypes::string(),
                ],
                'alias' => [
                    'type' => GraphqlTypes::string()
                ],
                'baseUrl' => [
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
