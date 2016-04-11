<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    protected $table = 'scripts';
    public $timestamps = true;
    protected $fillable = ['description, owner, name, function, structure'];

    public function comments()
    {
        return $this->hasMany('Kommentar', 'idScript');
    }
    
    public function user()
    {
        return $this->belongsTo('User','id');
    }
}
