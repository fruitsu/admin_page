<?php

$optional = ' <span class="text-muted">(optional)</span>';

return [
    'not_found' => 'Nothing found.',
    'delete_confirmation' => 'Are you sure you want to delete this entry?',

    'careers' => [
        'title' => 'Vacancies',
        'description' => 'Description',
        'fields' => [
            'title' => 'Vacancy',
            'description' => 'Description'
        ],
        'create' => [
            'button' => 'Create Vacancy',
        ],
            'messages' => [
                'created' => 'Vacancy created successfully.',
                'updated' => 'Vacancy updated successfully',
                'deleted' => 'Vacancy deleted successfully',

        ],

    ],

    'pages' => [
        'title' => 'Pages',
        'fields' => [
            'title' => 'Title',
            'body' => 'Description',
            'slug' => 'Slug',
        ],
        'create' => [
            'button' => 'Create Page',
        ],
        'meta' => [
            'fields' => [
                'title' => 'Title',
                'description' => 'Description'
            ]
        ],
        'edit' => [
            'title' => 'Edit page'
        ],
        'messages' => [
            'updated' => 'Page updated successfully.'
        ]
    ],

    'portfolios' => [
        'title' => 'Portfolios',
        'fields' => [
            'title' => 'Project name',
            'body' => 'Page content',
            'slug' => 'Slug'
        ],
        'create' => [
            'button' => 'Create Portfolio',
        ],
        'messages' => [
            'updated' => 'Page updated successfully.'
        ]
    ],

    'users' => [
        'title' => 'Users',
        'fields' => [
            'name' => 'Name',
            'role' => 'Role',
            'email' => [
                'label' => 'Email',
                'placeholder' => 'Must be unique and not used by another user'
            ],
            'password' => [
                'label' => 'Password',
                'placeholder' => '8 symbols minimum'
            ],
            'created_at' => 'Registered at'
        ],
        'create' => [
            'title' => 'New user',
            'button' => 'Create user'
        ],
        'roles' => [
            'admin' => 'Administrator',
            'manager' => 'Manager'
        ],
        'messages' => [
            'created' => 'User was created successfully.',
            'updated' => 'User was updated successfully.',
            'deleted' => 'User was deleted successfully.'
        ],

    ],

    'meta' => [
        'fields' => [
            'title' => 'Meta title',
            'description' => 'Meta description'
        ],
    ]
];
