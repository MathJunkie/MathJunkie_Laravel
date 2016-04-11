<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kommentar extends Model
{
    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('owner', 'text', 'seen', 'isScript', 'idScript');

    public function user()
    {
        return $this->belongsTo('User','id');
    }
}
