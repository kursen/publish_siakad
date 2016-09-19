<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class ModelUser extends Model
{
    //
    protected $table='users';
     protected $fillable = [
        'nim','nama', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
}
