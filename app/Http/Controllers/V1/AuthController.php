<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\CustomValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

use App\Services\User\UserService;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     *
     * @api {post} /auth/login Login
     * @apiVersion 1.0.0
     * @apiName Login
     * @apiGroup Auth
     *
     * @apiDescription Login
     *
     * @apiSampleRequest /api/v1/auth/login
     *
     * @apibody {String} [email] The user email.
     * @apibody {String} [password] The user password.
     *
     * @apiParamExample {json} Request-Example:
     *           {
     *               "email":"paulo@teste.com",
     *               "password": "secret"
     *           }
     *
     * @apiSuccess {Object} JWT with given credentials
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE2NTE4NzIwNjUsImV4cCI6MTY1MTg3NTY2NSwibmJmIjoxNjUxODcyMDY1LCJqdGkiOiJwNWdYRDN1S0t2WlhiY3N5Iiwic3ViIjoiNTEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.j0GEtCnWQE0jkVvQIuprXthufHEwyHJJHPRDhnu-uWc",
     *       "token_type": "bearer",
     *       "expires_in": 3600
     *     }
     *
     * @apiError Unauthorized Login failed.
     *
     *
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     *
     * @api {get} /auth/me Me
     * @apiVersion 1.0.0
     * @apiName Me
     * @apiGroup Auth
     *
     * @apiDescription Return the authenticated user
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *      {
     *          "id": 51,
     *          "name": "Paulo",
     *          "email": "paulo@teste.com",
     *          "document": "09420900045",
     *          "user_category_id": 1,
     *          "created_at": "2022-05-06T23:50:29.000000Z",
     *          "updated_at": "2022-05-06T23:50:29.000000Z"
     *      }
     *
     *
     *
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * @api {post} /auth/register Register
     * @apiName Register
     * @apiGroup Auth
     * @apiVersion 1.0.0
     *
     * @apiDescription Register a new user
     *
     * @apiSampleRequest /api/v1/auth/register
     *
     * @apibody {String} name The user name.
     * @apibody {String} email The user email.
     * @apibody {String} password The user password.
     * @apibody {String} password_confirmation The user password confirmation.
     * @apibody {String} document The user document.
     * @apibody {Number} user_category_id The user category id (1 - Personal, 2 - Jurical).
     *
     * @apiParamExample {json} Request-Example:
     *           {
     *               "email":"paulo@teste.com",
     *               "password": "secret",
     *               "password_confirmation": "secret",
     *               "name": "Paulo",
     *               "document": "09420900045",
     *               "user_category_id": 1
     *           }
     *
     */
    public function register(Request $request)
    {
        try {
            $this->service->register($request->all());
            return response()->json(['message' => 'Successfully registered']);
        } catch (CustomValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        // TODO: Need to refresh the token
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
