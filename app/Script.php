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
        return $this->hasMany('App\Kommentar');
    }
    
    public function user()
    {
        return $this->belongsToMany('App\User','owner');
    }
}
