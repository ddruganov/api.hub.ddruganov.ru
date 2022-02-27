<?php

return [
    'POST /api/v1/auth/login' => 'auth/login',
    'POST /api/v1/auth/login-into' => 'auth/login-into',
    'POST /api/v1/auth/signup' => 'auth/signup',
    'POST /api/v1/auth/logout' => 'auth/logout',
    'POST /api/v1/auth/refresh' => 'auth/refresh',
    'GET /api/v1/auth/current-user' => 'auth/current-user',

    'POST /api/v1/graphql' => 'graphql/index',

    // roles
    'POST /api/v1/roles' => 'role/create',
    'PATCH /api/v1/roles/<id:\d+>' => 'role/update',
    'DELETE /api/v1/roles/<id:\d+>' => 'role/delete',

    // permissions
    'POST /api/v1/permissions' => 'permission/create',
    'PATCH /api/v1/permissions/<id:\d+>' => 'permission/update',
    'DELETE /api/v1/permissions/<id:\d+>' => 'permission/delete',

    // users
    'POST /api/v1/users' => 'user/create',
    'PATCH /api/v1/users/<id:\d+>' => 'user/update',
    'DELETE /api/v1/users/<id:\d+>' => 'user/delete'
];
