<?php

return [
    '/api/students' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'index',
    ],
    '/api/students/show' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'show',
    ],
    '/api/students/create' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'create',
    ],
    '/api/students/update' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'update',
    ],
    
];
