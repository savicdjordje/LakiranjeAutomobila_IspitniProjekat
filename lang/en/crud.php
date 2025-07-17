<?php

return [
    'users' => [
        'itemTitle' => 'User',
        'collectionTitle' => 'Users',
        'inputs' => [
            'firstname' => [
                'label' => 'Firstname',
                'placeholder' => 'Firstname',
            ],
            'lastname' => [
                'label' => 'Lastname',
                'placeholder' => 'Lastname',
            ],
            'email' => [
                'label' => 'Email',
                'placeholder' => 'Email',
            ],
            'phone_number' => [
                'label' => 'Phone number',
                'placeholder' => 'Phone number',
            ],
            'password' => [
                'label' => 'Password',
                'placeholder' => 'Password',
            ],
            'role' => [
                'label' => 'Role',
                'placeholder' => 'Role',
            ],
        ],
    ],
    'services' => [
        'itemTitle' => 'Service',
        'collectionTitle' => 'Services',
        'inputs' => [
            'vehicle_id' => [
                'label' => 'Vehicle id',
                'placeholder' => 'Vehicle id',
            ],
            'employee_id' => [
                'label' => 'Employee id',
                'placeholder' => 'Employee id',
            ],
            'status_id' => [
                'label' => 'Status id',
                'placeholder' => 'Status id',
            ],
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'description' => [
                'label' => 'Description',
                'placeholder' => 'Description',
            ],
            'admin_id' => [
                'label' => 'Admin id',
                'placeholder' => 'Admin id',
            ],
        ],
    ],
    'vehicles' => [
        'itemTitle' => 'Vehicle',
        'collectionTitle' => 'Vehicles',
        'inputs' => [
            'licence_plate' => [
                'label' => 'Licence plate',
                'placeholder' => 'Licence plate',
            ],
            'make' => [
                'label' => 'Make',
                'placeholder' => 'Make',
            ],
            'model' => [
                'label' => 'Model',
                'placeholder' => 'Model',
            ],
            'year' => [
                'label' => 'Year',
                'placeholder' => 'Year',
            ],
            'client_id' => [
                'label' => 'Client id',
                'placeholder' => 'Client id',
            ],
        ],
    ],
    'statuses' => [
        'itemTitle' => 'Status',
        'collectionTitle' => 'Statuses',
        'inputs' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
        ],
    ],
    'bills' => [
        'itemTitle' => 'Bill',
        'collectionTitle' => 'Bills',
        'inputs' => [
            'price' => [
                'label' => 'Price',
                'placeholder' => 'Price',
            ],
            'service_id' => [
                'label' => 'Service id',
                'placeholder' => 'Service id',
            ],
        ],
    ],
];
