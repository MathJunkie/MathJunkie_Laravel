<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kommentar extends Model
{
    protected $table = 'comments';

    protected $fillable = ['owner, text, seen, isScript, idScript'];
}
