<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Controllers\Controller;

use League\Fractal;
use League\Fractal\Manager;

use App\User;
use App\Http\Controllers\Api\v1\Transformers\UserTransformer;

class UserController extends Controller
{
    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = new Manager();
    }

    public function create()
    {
        $user = new User;

        $resource = new Fractal\Resource\Item($user, new UserTransformer);

        return response([
          'status' => 'success',
          'data' => [
              'form' => $this->fractal->createData($resource)->toArray()['data']
          ]
      ]);
    }
    public function index()
    {
        $users = User::orderBy('created_at')->get();

        $resource = new Fractal\Resource\Collection($users, new UserTransformer);

        return response([
            'status' => 'success',
            'data' => [
                'users' => $this->fractal->createData($resource)->toArray()['data']
            ]
        ]);
    }

    public function update(StoreUser $request, $id)
    {
        $user = User::findOrFail($id)->fill($request->all());
        $user->save();

        $user->roles()->sync($request->input('roles'));

        $resource = new Fractal\Resource\Item($user, new UserTransformer);

        return response([
            'status' => 'success',
            'data' => [
                'user' => $this->fractal->createData($resource)->toArray()['data']
            ]
        ]);
    }

    public function store(StoreUser $request)
    {
        $user = new User($request->all());
        $user->password = app('hash')->make('12345678');
        $user->save();

        $user->roles()->sync($request->input('roles'));

        $resource = new Fractal\Resource\Item($user, new UserTransformer);

        return response([
            'status' => 'success',
            'data' => [
                'user' => $this->fractal->createData($resource)->toArray()['data']
            ]
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $resource = new Fractal\Resource\Item($user, new UserTransformer);

        return response([
            'status' => 'success',
            'data' => [
                'user' => $this->fractal->createData($resource)->toArray()['data']
            ]
        ]);
    }
}
