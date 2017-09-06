<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    'name', 'slug', 'desc'
  ];

    protected $attributes = [
      'name' => '',
      'slug' => '',
      'desc' => ''
  ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'created_at', 'updated_at'
  ];
}
