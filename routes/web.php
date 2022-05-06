<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

$router->get('/', function () use ($router) {
   // return 'Projeto PP - Versão 0.0.0.1';
   return User::with('wallet')->where('id', 1)->get();	
});

$router->group (['prefix' => 'auth'], function () use ($router) {
      $router->post('/login', 'AuthController@login');
});

$router->group (['prefix' => 'auth', 'middleware' => 'auth'], function () use ($router) {
      $router->get('/me', 'AuthController@me');
});

