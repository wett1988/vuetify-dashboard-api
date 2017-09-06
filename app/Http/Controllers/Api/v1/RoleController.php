<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use App\Http\Controllers\Controller;

use App\Role;

class RoleController extends Controller
{
    public function create()
    {
        return response([
      'status' => 'success',
      'data' => [
          'form' => new Role
      ]
  ]);
    }
    public function index()
    {
        $roles = Role::orderBy('created_at')->get();

        return response([
        'status' => 'success',
        'data' => [
            'roles' => $roles
        ]
    ]);
    }

    public function update(StoreRole $request, $id)
    {
        $role = Role::findOrFail($id)->fill($request->all());
        $role->save();

        return response([
        'status' => 'success',
        'data' => [
            'role' => $role
        ]
    ]);
    }

    public function store(StoreRole $request)
    {
        $role = new Role($request->all());
        $role->save();

        return response([
        'status' => 'success',
        'data' => [
            'role' => $role
        ]
    ]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response([
        'status' => 'success',
        'data' => [
            'role' => $role
        ]
    ]);
    }
}
