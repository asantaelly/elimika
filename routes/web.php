<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ADMIN ROUTES

Route::prefix('admin')->middleware('role:admin')->group(function () {

    /**
     * admin internal routes
     */ 
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    
    /**
     *  Instructor Management Routes 
     */ 
    Route::get('/instructor_manage', 'AdminController@instructor_manage')->name('manage_instructor');
    Route::get('/add_instructor', 'AdminController@add_instructor')->name('add_instructor');
    Route::post('/add_instructor', 'AdminController@store_instructor')->name('store_instructor');
    Route::get('/instructor_manage/{id}', 'AdminController@showInstructor')->name('show_instructor');
    Route::post('/assign_instructor', 'AdminController@assign_course')->name('assign_instructor');

    /**
     * Student Management Routes 
     */ 
    Route::get('/student_manage', 'AdminController@student_manage')->name('manage_student');
    Route::get('/student_manage/{id}', 'AdminController@showStudent')->name('show_student');


    /**
     *  Couse Management Routes
     */
    Route::get('/course_manage', 'AdminController@showCourses')->name('manage_course');
    Route::get('/add_course', 'AdminController@addCourse')->name('add_course');
    Route::post('/store_course', 'AdminController@storeCourse')->name('store_course');
    Route::get('/assign_course/{id}', 'AdminController@showCourse')->name('assign_course');
});



// INSTRUCTOR ROUTES
Route::prefix('instructor')->middleware('role:instructor')->group(function (){
    Route::get('/', 'InstructorController@index')->name('instructor.dashboard');
    Route::get('/courses', 'InstructorController@showCourses')->name('instructor.courses');
    Route::get('/courses/{id}', 'InstructorController@courseSpace')->name('course.space');
    Route::get('/add_material/{course_name}/{id}', 'InstructorController@addMaterial')->name('add.materials');
    Route::post('/add_materials/{id}', 'InstructorController@storeMaterials')->name('store.materials');
    Route::get('/show_notes/{id}', 'InstructorController@showNotes')->name('show.notes');
    Route::get('show_notes/{id}/add_quiz', 'InstructorController@addQuiz')->name('add.quiz');
    Route::post('/show_notes/{id}/store_quiz', 'InstructorController@storeQuiz')->name('store.quiz');
    Route::get('/notes/{id}/quiz', 'InstructorController@showQuiz')->name('show.quiz');
    Route::get('/courses/upload/files/{id}', 'InstructorController@storeDocs')->name('add.files');
    Route::get('/courses/students/evaluation/{id}', 'InstructorController@studentsEvaluation')->name('students.evaluation');
    Route::get('/documents/{id}', 'InstructorController@showUpload')->name('upload.files');
    Route::post('/documents/{id}', 'InstructorController@storeDocs')->name('store.docs'); // Store documents
});




// STUDENT ROUTES
Route::prefix('student')->middleware('role:student')->group(function (){
    Route::get('/', 'StudentController@index')->name('student.dashboard');
    Route::get('/courses', 'StudentController@showCourses')->name('student.courses');
    Route::get('/course/{id}', 'StudentController@showCourse')->name('show.course');
    Route::get('/list/courses', 'StudentController@availableCourses')->name('courses.list');
    Route::post('/course/{id}', 'StudentController@storeUserCourse')->name('store.user.course');
    Route::get('/course', 'StudentController@showStudentsCourse')->name('show.students.course');
    Route::get('/read_course/{id}', 'StudentController@student_reading')->name('read.course');
    Route::get('/show_notes/{id}', 'StudentController@showNotes')->name('student.show.notes');
    Route::get('/notes/{id}/quiz', 'StudentController@showQuiz')->name('show.quiz.student');
    Route::post('/notes/{id}/store_quiz', 'StudentController@quizSubmission')->name('quiz.submission');
});




