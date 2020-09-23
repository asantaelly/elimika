<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function instructor(){
        return $this->hasOne('App\Instructor');
    }


    // Many to many relationship
    public function courses(){
        return $this->belongsToMany('App\Course', 'course_user', 'user_id', 'course_id');
    }


    /**
     *  Checking the role of the authenticated user
     *  @param string $role
     *  @return boolean
     */
    public function hasRole($role) {
        $user_role = Auth::user()->role;
        if($user_role === $role) {
            return true;
        }
        return false;
    }

    public function quiz_submissions(){
        return $this->hasMany('App\QuizSubmission');
    }
}
