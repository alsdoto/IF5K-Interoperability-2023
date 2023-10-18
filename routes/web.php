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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/hello-lumen', function () {
    return "<h1>Lumen</h1><p>Hi good developer, thank for using Lumen</p>";
});

$router->get('/hello-lumen/{name}', function ($name) {
    return "<h1>Lumen</h1><p>Hi <b>". $name ."</b>, thank for using Lumen</p>";
});

$router->get('/scores', ['middleware' => 'login', function (){
    return "<h1>Selamat</h1><p>Nilai anda 100</p>";
}]);

// $router->get('/users', 'UsersController@index');

//1
$router->get('/', 'ServiceController@getServiceStatus');

// 2
$router->get('/users', 'UsersController@getUsers');

// 3
$router->get('/users/{userId}', 'UserController@getUserById');

$router->get('posts', 'PostsController@index');

$router->get('/table1', 'Table1Controller@index');
$router->get('/table1/{id}', 'Table1Controller@show');
$router->post('/table1', 'Table1Controller@store');
$router->put('/table1/{id}', 'Table1Controller@update');
$router->delete('/table1/{id}', 'Table1Controller@destroy');

$router->get('/table2', 'Table2Controller@index');
$router->get('/table2/{id}', 'Table2Controller@show');
$router->post('/table2', 'Table2Controller@store');
$router->put('/table2/{id}', 'Table2Controller@update');
$router->delete('/table2/{id}', 'Table2Controller@destroy');

$router->get('/table3', 'Table3Controller@index');
$router->get('/table3/{id}', 'Table3Controller@show');
$router->post('/table3', 'Table3Controller@store');
$router->put('/table3/{id}', 'Table3Controller@update');
$router->delete('/table3/{id}', 'Table3Controller@destroy');

$router->get('/table4', 'Table4Controller@index');
$router->get('/table4/{id}', 'Table4Controller@show');
$router->post('/table4', 'Table4Controller@store');
$router->put('/table4/{id}', 'Table4Controller@update');
$router->delete('/table4/{id}', 'Table4Controller@destroy');

$router->get('/table5', 'Table5Controller@index');
$router->get('/table5/{id}', 'Table5Controller@show');
$router->post('/table5', 'Table5Controller@store');
$router->put('/table5/{id}', 'Table5Controller@update');
$router->delete('/table5/{id}', 'Table5Controller@destroy');
