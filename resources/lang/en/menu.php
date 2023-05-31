<?php

return [
    'dashboard' => 'Dashboard',
    'home'=>'Home layout',
    'product' => [
        'header' => 'Product category and product',
        'header_sub'=>'Product',
        'sub' => [
            'product_category'=>[
                'header'=>'Product category',
                'list' => 'List',
                'add' => 'Add new',
            ],
            'product'=>[
                'header'=>'Product',
                'list' => 'List',
                'add' => 'Add new',
            ],
            'feature'=>[
                'header'=>'Feature',
                'list'=>'List',
                'add'=>'Add new'
            ]
        ]
    ],
    'post' => [
        'header' => 'Blog category and Blog',
        'header_sub'=>'Post',
        'sub' => [
            'blog_category'=>[
                'header'=>'Blog category',
                'list' => 'List blog category',
                'add' => 'Add new',
            ],
            'blog'=>[
                'header'=>'Blog',
                'list' => 'List blog',
                'add' => 'Add new',
            ],
        ]
    ],
    'user' => [
        'header' => 'User and profile',
        'header_sub'=>'User',
        'sub' => [
            'list' => 'List',
            'profile' => 'Profile',
        ]
    ],
    'administrator' => [
        'header' => 'Administrator',
        'sub' => [
            'role' => 'Role',
            'permission' => 'Permission',
        ]
    ],
    'setting' => [
        'header' => 'Settings',
        'sub_header'=>'General settings',
        'sub' => [
            'website'=>'Website settings'
        ]
    ]
];
