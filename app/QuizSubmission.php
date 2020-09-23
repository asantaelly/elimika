<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    protected $table = 'quiz_submissions';

    public function questions(){
        return $this->belongsTo('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
