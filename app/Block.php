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
        return $this->morphMany('App\Kommentar','commentable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
