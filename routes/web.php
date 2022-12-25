<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('', function () {
    return redirect('api/v1');
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->get('', function () {
        return response()->json([
            'message' => 'welcome to indonesia weather api',
            'source'  => 'https://data.bmkg.go.id/prakiraan-cuaca/',
            'creator' => 'https://github.com/korospace',
        ]);
    });

    $router->get('province', ['uses' => "ApiV1Controller@getProvince"]);

    $router->get('city',     ['uses' => "ApiV1Controller@getCity"]);

    $router->get('weather',  ['uses' => "ApiV1Controller@getWeather"]);

});
