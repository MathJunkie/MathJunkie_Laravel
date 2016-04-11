<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'block';
    public $timestamps = true;
    protected $fillable = ['name, structure, function, owner, category, description, xml'];

    public function comments()
    {
        return $this->hasOne('Kommentar', 'idScript');
    }

    public function user()
    {
        return $this->belongsTo('User','id');
    }
}
