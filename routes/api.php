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

app('Dingo\Api\Routing\Router')->version('v1', [
    'namespace'  => 'App\Http\Controllers\Api',
    'middleware' => ['bindings', 'api.throttle'],
], function ($api) {

    $api->group(['prefix' => 'auth'], function ($api) {
        $api->post('login', 'AuthController@login');
    });

    $api->group(['middleware' => 'auth:api'], function ($api) {

        $api->group(['prefix' => 'eggs'], function ($api) {
            $api->get('', 'EggsController@index');
            $api->post('', 'EggsController@store');
            $api->put('{egg}/done', 'EggsController@done');
            $api->delete('{egg}', 'EggsController@destroy');
        });

    });

});
