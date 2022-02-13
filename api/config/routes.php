<?php

return [
    'POST /api/v1/auth/login' => 'auth/login',
    'POST /api/v1/auth/logout' => 'auth/logout',
    'POST /api/v1/auth/refresh' => 'auth/refresh',
    'GET /api/v1/auth/current-user' => 'auth/current-user',

    'POST /api/v1/graphql' => 'graphql/index',

    'POST /api/v1/roles' => 'role/create',
    'PATCH /api/v1/roles/<id:\d+>' => 'role/update',
    'DELETE /api/v1/roles/<id:\d+>' => 'role/delete'
];
