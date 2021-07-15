<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    protected $fillable = ['code', 'name', 'surname', 'email', 'startdate'];

}
