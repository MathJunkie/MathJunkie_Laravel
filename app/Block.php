<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'block';

    protected $fillable = ['name, structure, function, owner, category, description, xml'];
}
