<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function answer_choice(){
        return $this->hasMany('App\AnswerChoice');
    }

    public function quiz_submissions(){
        return $this->hasOne('App\QuizSubmission');
    }
}
