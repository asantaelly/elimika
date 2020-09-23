<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    protected $table = 'instructors';

    protected $fillable = [
        'professional',
    ];
    
    public function  user(){

        return $this->belongsTo('App\User');
    }
}
