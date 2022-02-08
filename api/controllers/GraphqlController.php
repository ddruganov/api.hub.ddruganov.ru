<?php

namespace api\controllers;

use api\graphql\GraphqlTypes;
use ddruganov\Yii2ApiAuth\http\controllers\SecureApiController;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\http\actions\ApiAction;
use ddruganov\Yii2ApiEssentials\http\actions\ClosureAction;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

final class GraphqlController extends SecureApiController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => ClosureAction::class,
                'closure' => function (ApiAction $apiAction) {
                    $schema = new Schema(['query' => GraphqlTypes::query()]);
                    $result = GraphQL::executeQuery(
                        $schema,
                        $apiAction->getData('query')
                    );
                    if ($result->errors) {
                        return ExecutionResult::exception(@reset($result->errors));
                    }

                    return ExecutionResult::success($result->data);
                }
            ]
        ];
    }
}
