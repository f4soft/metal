<?php
return [
    'guest' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'adminAccess',
        ],
    ],
    'adminAccess' => [
        'type' => 2,
        'description' => 'Access to site admin panel',
    ],
];
