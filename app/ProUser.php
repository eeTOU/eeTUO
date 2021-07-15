<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProUser extends Model
{
    protected $table='pro_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'prouser_name', 'prouser_email', 'prouser_password', 'check_pro'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'prouser_password', 'remember_token',
    ];
}
