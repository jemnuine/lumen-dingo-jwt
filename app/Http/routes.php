<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers'], function ($api) {
        $api->group(['middleware' => 'jwt.auth'], function ($api) {
            $api->get('/', 'PageController@index');
        });

        // Auth routes
        $api->group(['namespace' => 'Auth'], function ($api) {
            $api->post('/login', 'AuthController@postLogin');
            $api->delete('/login', 'AuthController@deleteLogin');
        });
    });
});
