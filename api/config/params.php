<?php

return [
    'authentication' => [
        'masterPassword' => [
            'enabled' => false,
            'value' => ''
        ],
        'tokens' => [
            'secret' => '',
            'access' => [
                'ttl' => 60 * 60, // seconds
                'issuer' => 'localhost',
                'audience' => 'localhost'
            ],
            'refresh' => [
                'ttl' => 60 * 60 * 24 * 30 // seconds
            ]
        ]
    ]
];
