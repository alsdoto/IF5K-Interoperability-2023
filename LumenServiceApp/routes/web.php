<?php

use App\Http\Controllers\Public\PostController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Public\StudentController;
use App\Http\Controllers\Public\ProductCategoryController;
use App\Http\Controllers\Public\HumanController;
use App\Http\Controllers\Public\LuctureController;


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

$router->get('/hello-lumen/{name}', function ($name) {
    return "<h1>Hello $name</h1>";
});

$router->get('/scores', ['middleware' => 'login', function () {
    return 'Selamat datang di halaman skor';
}]);

$router->get('/', 'phpServiceController@index');
$router->get('/users', 'phpServiceController@user');
$router->get('/users/{id}', 'phpServiceController@user');

$router->get('humans', 'HumanController@index');

// Post Contoller
// $router->group(['middleware' => 'auth'], function () use ($router) {
$router->get('posts', 'PostController@index');
$router->post('posts', 'PostController@store');
$router->get('posts/{id}', 'PostController@show');
$router->put('posts/{id}', 'PostController@update');
$router->delete('posts/{id}', 'PostController@destroy');
$router->get('posts/image/{imageName}', 'PostController@image');
$router->get('posts/video/{videoName}', 'PostController@video');

$router->post('profiles', 'ProfileController@store');
// });

$router->get('/profiles/{userId}', 'ProfileController@show');
$router->get('/profiles/image/{imageName}', 'ProfileController@image');


// Lucture Contoller
$router->get('lucture', 'LuctureController@index');
$router->post('lucture', 'LuctureController@store');
$router->get('lucture/{id}', 'LuctureController@show');
$router->put('lucture/{id}', 'LuctureController@update');
$router->delete('lucture/{id}', 'LuctureController@destroy');

// Human Controller
$router->get('human', 'HumanController@index');
$router->post('human', 'HumanController@store');
$router->get('human/{id}', 'HumanController@show');
$router->put('human/{id}', 'HumanController@update');
$router->delete('human/{id}', 'HumanController@destroy');

// Productcategory Controller
$router->get('product', 'ProductCategoryController@index');
$router->post('product', 'ProductController@store');
$router->get('product/{id}', 'ProductController@show');
$router->put('product/{id}', 'ProductController@update');
$router->delete('product/{id}', 'ProductController@destroy');

// Student Controller
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('student', 'StudentController@index');
    $router->post('student', 'StudentController@store');
    $router->get('student/{id}', 'StudentController@show');
    $router->put('student/{id}', 'StudentController@update');
    $router->delete('student/{id}', 'StudentController@destroy');
});

// User Controller
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});


// $router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('public/post', 'PublicController\PostController@index');
    $router->get('public/post/{id}', 'PublicController\PostController@show');
    $router->post('public/post', 'PublicController\PostController@store');
// });
