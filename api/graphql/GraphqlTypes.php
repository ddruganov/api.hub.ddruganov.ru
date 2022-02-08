<?php

namespace api\graphql;

use api\graphql\rbac\PermissionGql;
use api\graphql\rbac\RoleGql;
use GraphQL\Type\Definition\Type;

class GraphqlTypes extends Type
{
    private static array $types = [];

    public static function query(): QueryGql
    {
        return (self::$types['query'] ??= new QueryGql());
    }

    public static function roleType(): RoleGql
    {
        return (self::$types['role'] ??= new RoleGql());
    }

    public static function permissionType(): PermissionGql
    {
        return (self::$types['permission'] ??= new PermissionGql());
    }
}
