<?php

return [
    '/api/auth/login' => [
        'controller' => 'Auth\\Controllers\\AuthController',
        'method' => 'login',
    ],
    '/api/auth/protected' => [
        'controller' => 'Auth\\Controllers\\AuthController',
        'method' => 'protectedRoute',
    ],
    '/api/student' => [
        'controller' => 'Student\\Controllers\\DashboardController',
        'method'     => 'index',
    ],
    
    '/api/student/show' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'show',
    ],
    '/api/student/create' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'create',
    ],
    '/api/student/update' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'update',
    ],

];
