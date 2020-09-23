<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $table = 'notes';

    public function course(){
        return $this->belongsTo('App\Course');
    }

}
