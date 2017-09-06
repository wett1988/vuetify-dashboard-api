<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\v1',
], function ($app) {
    $app->post('/auth/login', [ 'as' => 'login', 'uses' => 'AuthController@login']);
    $app->post('/auth/register', 'AuthController@register');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\v1',
    'middleware' => ['auth:api'],
], function ($app) {
    $app->post('/auth/logout', 'AuthController@logout');
//    $app->post('/auth/login-other', 'AuthController@loginOther');
    $app->get('/auth/user', 'AuthController@user');

    $app->get('/auth/refresh', 'AuthController@refresh');

    $app->resource('users', 'UserController');
    $app->resource('roles', 'RoleController');
});

// Route::group([
//     'prefix' => 'v1',
//     'namespace' => 'Api\v1',
//     'middleware' => ['auth:api', 'scopes:regular'],
// ], function ($app) {
//     $app->resource('users', 'UserController');
//     $app->resource('roles', 'RoleController');
// });
