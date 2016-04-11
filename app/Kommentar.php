<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kommentar extends Model
{
    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('text', 'seen');
    protected $morphClass = 'Kommentar';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function commentable(){
        return $this->morphTo();
    }

    /*public function script(){
        return $this->belongsTo('App\Script');
    }

    public function block(){
        return $this->belongsTo('App\Block');
    }*/
}
