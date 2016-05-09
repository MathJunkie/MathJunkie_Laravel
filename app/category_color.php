<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_color extends Model
{
    protected $table = 'category_color';
    public $timestamps = false;
    protected $fillable = ['structure,color'];
}
