<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    public $table = 'courses';
    

    // Many to Many relationship with user
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }
}
