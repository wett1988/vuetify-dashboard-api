<?php
namespace App\Http\Controllers\Api\v1\Transformers;

use App\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
          'id'     => (int) $user->id,
          'name'   => (string) $user->name,
          'email'   => (string) $user->email,
          'roles' => (array) $user->roles()->pluck('id')->toArray(),
          'scopes' => (array) $user->scopes()
        ];
    }
}
