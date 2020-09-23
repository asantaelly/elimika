<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Note;
use App\Question;
use App\QuizSubmission;


class StudentController extends Controller
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

    // Return student dashboard
    public function index(){

        $user = Auth::user();
        $courses = Course::all();

        // return dd($user->courses);
        return redirect()->route('show.students.course');

        // return view('dashboards/student/index')->with([
        //             'user' => $user,
        //             'courses' => $courses,
        //         ]);
    }

    // Return available courses for student to be enrolled to
    public function showCourses(){
        $user = Auth::user();
        return view('dashboards/student/courses')->with([
            'user' => $user,
        ]);
    }

    public function showCourse($id){

        $course = Course::find($id);
        return view('dashboards/student/show_course')->with([
            'course' => $course,
        ]);
    
    }

    // Returns instance of course and student
    public function storeUserCourse(Request $request, $id)
    {

        try {
            DB::table('course_user')->insert([
                'user_id' => Auth::user()->id,
                'course_id' => $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } catch (Throwable $th) {
            throw $th;
        }
        return redirect()->route('home');
    }

    // Creating student learning space
    public function showStudentsCourse(Request $request){

        $user = Auth::user();
        $user_courses = DB::table('course_user')
                    ->where('user_id', $user->id)->get();
        foreach($user_courses as $course){
            $getCourse = DB::table('courses')
                ->where('id', $course->course_id)->first();
            $courses[] = $getCourse;
        }

        return view('dashboards/student/student_course')->with([
            'user' => $user,
            'courses' => $courses
        ]);

    }

    public function student_reading($id){

        $course = Course::find($id);
        $user = Auth::user();
        return view('dashboards/student/course_read')->with([
            'course' => $course,
            'user' => $user,
        ]);
    }

    // Show single instance of the notes
    public function showNotes($id){

        $notes = Note::find($id);
        $user = Auth::user();

        $user_submitted_quiz = QuizSubmission::where([
            'user_id' => Auth::user()->id,
            'note_id' => $id
            ])->get();

        if($user_submitted_quiz->isNotEmpty()){
            $quiz_submitted = TRUE;
        } else {
            $quiz_submitted = FALSE;
        }


        return view('dashboards/student/show_notes')->with([
            'notes' => $notes,
            'user' => $user,
            'quiz_submitted' => $quiz_submitted,
            'submitted_quiz' => $user_submitted_quiz,
        ]);

    }


    public function showQuiz($id){

        $notes = Note::find($id);
        $questions = Question::where('note_id', $id)->get();

        $user = Auth::user();

        $user_submitted_quiz = QuizSubmission::where([
            'user_id' => Auth::id(),
            'note_id' => $id
            ])->get();

        if($user_submitted_quiz->isNotEmpty()){
            $quiz_submitted = TRUE;
        } else {
            $quiz_submitted = FALSE;
        }

        return view('dashboards/student/show_quiz')->with([
            'notes' => $notes,
            'questions' => $questions,
            'user' => $user,
            'quiz_submitted' => $quiz_submitted,
            'submitted_quiz' => $user_submitted_quiz,
        ]);

    }

    // Submitting quiz
    public function quizSubmission(Request $request, $id){

        // $request->validate([
        //     'answer.*.letter' => 'required',
        //     'question.*.number' => 'required',
        // ]);

        // Local Variables
        $user = Auth::user();
        $notes = Note::find($id);
        $questions = Question::where('note_id', $id)->get();

        // Submitted User Data
        $question_numbers = $request->input('question.*.number');
        $question_answers = $request->input('answer.*.letter');
        $qnumbers_answers = array_combine($question_numbers, $question_answers);

        if($qnumbers_answers == FALSE){
            return redirect()->route('show.quiz.student', [$notes])->with(
                'status', 'Make sure there are no empty values.',
            );
        }


        foreach($qnumbers_answers as $number => $answer){

            $question_exists = Question::where('id', $number)->get();

            if($question_exists->isEmpty()){
                return redirect()->route('show.quiz.student', [$notes])
                ->with([
                    'status' =>'Question does not exists, Please consult your instructor!',
                    'question' => $questions,
                    'user' => $user,
                    'notes' => $notes
                ]);
            }

            if($answer == null){
                $answer = 'X';
            }

            $original_question = DB::table('questions')->where([
                'id' => $number,
                'note_id' => $id,
            ])->first();

            if($original_question->answer == $answer){
                $correctness = TRUE;
            } else {
                $correctness = FALSE;
            }

            $quiz_submission = new QuizSubmission;
            $quiz_submission->question_id = $number;
            $quiz_submission->user_id = Auth::user()->id;
            $quiz_submission->note_id = $id;
            $quiz_submission->answer_chosen = $answer;
            $quiz_submission->correctness = $correctness;
            $quiz_submission->save();
        }

        $user_submitted_quiz = QuizSubmission::where([
            'user_id' => Auth::user()->id,
            'note_id' => $id
            ])->get();

        
        if(!empty($user_submitted_quiz)){
            $quiz_submitted = TRUE;
        } else {
            $quiz_submitted = FALSE;
        }

        // return view('dashboards/student/show_notes')->with([
        //     'notes' => $notes,
        //     'user' => $user,
        //     'quiz_submitted' => $quiz_submitted,
        //     'success' => 'Quiz submitted successfully',
        // ]);

        return redirect()->route('show.quiz.student', [$notes])
                ->with([
                    // 'status' =>'Question does not exists, Please consult your instructor!',
                    'question' => $questions,
                    'user' => $user,
                    'notes' => $notes,
                    'quiz_submitted' => $quiz_submitted,
                    'submitted_quiz' => $user_submitted_quiz
                ]);

    }


}
