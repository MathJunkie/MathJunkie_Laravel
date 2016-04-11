<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'block';
    public $timestamps = true;
    protected $fillable = ['name, structure, function, category, description, xml'];

    public function comments()
    {
        return $this->hasMany('App\Kommentar');
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
