<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerChoice extends Model
{
    protected $table = 'answer_choices';

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
