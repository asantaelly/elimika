<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Course;
use App\Instructor;

class AdminController extends Controller
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

    // Return admin dashboard
    public function index(){

        $courses = Course::all();
        $users = User::all();

        return view('dashboards/admin/home')->with([
            'courses' => $courses,
            'users' => $users
        ]);
    }


    //  Return instructor management view
    public function instructor_manage(){

        $trainers = User::where('role', 'instructor')->with('instructor')->get(); 
        return view('dashboards.admin.manage_instructor')->with([
            'trainers' => $trainers,
        ]);
    }

    //  Return student management view
    public function student_manage() {

        $students = User::where('role', 'student')->get();
        return view('dashboards.admin.manage_student')->with([
            'students' => $students,
        ]);
    }

    // Function to show Student model
    public function showStudent($id) {

        $student = User::where('id', $id)->first();

        if(empty($student)){
            return redirect()->route('manage_student');
        }

        return view('dashboards.admin.show_student')->with([
            'student' => $student,
        ]);
    }


    // Function to show Instructor resource
    public function showInstructor($id){

        $trainer = User::find($id);

        if(empty($trainer)){
            return redirect()->route('manage_instructor');
        }

        return view('dashboards.admin.show_instructor')->with([
            'trainer' => $trainer,
        ]);

    }


    // Register instructor to the system
    public function add_instructor(){
        return view('dashboards.admin.add_instructor');
    }

    public function store_instructor(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->role = 'instructor';
        $user->mobile_number = $request->mobile_number;
        $user->gender = $request->gender;
        $user->save();

        if($request->professional){

            DB::table('instructors')->insert([
                'user_id' => $user->id,
                'professional' => $request->professional,
            ]);

        }

        return redirect()->route('manage_instructor');
    }


    // Function to view course provided
    public function showCourses(){
        
        $courses = Course::all();

        return view('dashboards.admin.manage_course')->with([
            'courses' => $courses,
        ]);

    }

    // Method to show only single instance of the course
    public function showCourse($id) {

        $course = Course::find($id);
        $trainers = User::where('role', 'instructor')->with('instructor')->get();

        return view('dashboards.admin.show_course')->with([
            'course' => $course,
            'trainers' => $trainers
        ]);
    }

    // Return a form to add new course
    public function addCourse(){
        return view('dashboards.admin.add_course');
    }

    // Function to add new course to the system
    public function storeCourse(Request $request){

        $request->validate([
            'course_name' => 'required',
            'course_description' => 'required',
        ]);

        $course = new Course;
        $course->course_name = $request->course_name;
        $course->course_description = $request->course_description;
        $course->save();

        return redirect()->route('manage_course');

    }

    // Method to assign course to an instructor to teach through the system
    public function assign_course(Request $request) {

        try {
            DB::table('course_user')->insert([
                'user_id' => $request->trainer_id,
                'course_id' => $request->course_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } catch (Throwable $th) {
            throw $th;
        }
        return redirect()->route('manage_instructor');

    }

}
