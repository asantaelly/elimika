<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'student':
                return redirect()->action('StudentController@index');
                break;
            case 'instructor':
                return redirect()->action('InstructorController@index');
                break;
            case 'admin':
                return redirect()->action('AdminController@index');
                break;
            default:
                return view('auth.login');
                break;
        }
    }
}
