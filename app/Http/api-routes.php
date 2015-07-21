<?php
use Dingo\Api\Routing\Router;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [ 'namespace' => 'App\Http\Controllers\Api\V1'], function (Router $api)
{
    /** @var \Dingo\Api\Routing\Router $api */
    $api->group([ 'middleware' => [ 'api.auth', 'api.permission' ] ], function (Router $api)
    {


        $api->resource('user', 'UserController', [
            'except' => [ 'create', 'edit', 'show', 'destroy' ],
            'names'  => [
                'index'  => 'api.user',
                'update' => 'api.user.update',
                'store'  => 'api.user.register'
            ]
        ]);


        $api->group([ 'prefix' => 'admin', 'namespace' => 'Admin'], function (Router $api)
        {
            $api->resource('users', 'UsersController', [
                'except' => [ 'create', 'edit' ],
                'names'  => [
                    'index'   => 'api.admin.users.list',
                    'update'  => 'api.admin.users.update',
                    'store'   => 'api.admin.users.create',
                    'show'    => 'api.admin.users.show',
                    'destroy' => 'api.admin.users.remove'
                ]
            ]);
        });
    });

    //$api->post('user/login', 'UserController@postLogin');
    //$api->get('config', 'ApiController@getConfig');
    //, ['namespace' => 'App\Http\Controllers\Api\V1'],
});
