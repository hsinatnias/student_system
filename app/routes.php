<?php

return [
    '/api/auth/me' => [
        'controller' => 'Auth\\Controllers\\AuthController',
        'method'     => 'me',
    ],
    '/api/auth/login' => [
        'controller' => 'Auth\\Controllers\\AuthController',
        'method' => 'login',
    ],
    '/api/auth/protected' => [
        'controller' => 'Auth\\Controllers\\AuthController',
        'method' => 'protectedRoute',
    ],
    '/api/auth/register' => [
        'controller' => 'Auth\\Controllers\\AuthController',
        'method' => 'register',
    ],
    '/api/student' => [
        'controller' => 'Student\\Controllers\\StudentController',
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
    '/api/student/delete' => [
        'controller' => 'Student\\Controllers\\StudentController',
        'method'     => 'delete',
    ],

];
