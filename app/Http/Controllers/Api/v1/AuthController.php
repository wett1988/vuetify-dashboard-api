<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Requests\LoginUser;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use League\Fractal;
use League\Fractal\Manager;

use App\User;
use App\Http\Controllers\Api\v1\Transformers\UserTransformer;

class AuthController extends Controller
{
    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = new Manager();
    }
    public function login(LoginUser $request)
    {
        // $params = $request->only('email', 'password');

        $email = $request->input('email');
        $password = $request->input('password');

        $token = (object)['accessToken' => ''];

        if (\Auth::attempt(['email' => $email, 'password' => $password ])) {
            Log::info(\Auth::user());

            $token = \Auth::user()->createToken(
              'my_user',
              \Auth::user()->scopes()
            );
            return response([
                'status' => 'success'
            ])
            ->header('Authorization', $token->accessToken);
        }

        return response([
            'status' => 'error',
            'validator' => [
              'message' => 'Invalid credentials'
            ]
        ]);
    }

    public function logout(Request $request)
    {
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function refresh(Request $request)
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function user(Request $request)
    {
        $resource = new Fractal\Resource\Item($request->user(), new UserTransformer);

        return response([
            'status' => 'success',
            'data' =>  $this->fractal->createData($resource)->toArray()['data']
        ]);
    }
}
