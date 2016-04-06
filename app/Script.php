<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    protected $table = 'scripts';

    protected $fillable = ['description, owner, name, function, structure'];
}
