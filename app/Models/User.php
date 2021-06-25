<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
  use HasFactory;

  public $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'bio',
    'gender',
    'birthdate',
    'is_active',
  ];

  protected $hidden = [
    'password',
  ];

  protected $casts = [
    'is_active' => 'boolean',
    'birthdate' => 'date',
  ];
}
