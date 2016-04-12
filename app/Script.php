<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    protected $table = 'scripts';
    public $timestamps = true;
    protected $fillable = ['description, name, function, structure'];

    public function comments()
    {
        return $this->morphMany('App\Kommentar','commentable');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
