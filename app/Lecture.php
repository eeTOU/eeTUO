<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['code', 'name', 'ismandatory', 'day', 'hour'];

}