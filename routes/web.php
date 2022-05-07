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
      return 'Projeto PP - Version 1.0';   
});

$router->group (['prefix' => 'apidoc'], function () use ($router) {      
      $router->get('', function () {
            return redirect('doc/index.html');
      });
});

$router->group (['prefix' => 'api/v1/auth', 'namespace' => 'V1'], function () use ($router) {
      $router->post('/login', 'AuthController@login');
      $router->post('/register', 'AuthController@register');
});

$router->group (['prefix' => 'api/v1/auth', 'namespace' => 'V1', 'middleware' => 'auth' ], function () use ($router) {
      $router->get('/me', 'AuthController@me');
});


$router->group (['prefix' => 'api/v1/transaction', 'namespace' => 'V1', 'middleware' => 'auth' ], function () use ($router) {
      $router->post('/deposit', 'TransactionController@deposit');
});



