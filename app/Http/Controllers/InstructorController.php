<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\MaterialUploaded;
use Illuminate\Support\Facades\Notification;
use App\Course;
use App\Note;
use App\Quiz;
use App\Question;
use App\AnswerChoice;
use App\QuizSubmission;
use Carbon\Carbon;
use App\User;

class InstructorController extends Controller
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


    // Returns instructor dashboard
    public function index(){

        $user = User::where('id', Auth::id())->first();
        $courses = $user->courses()->get();
        $students_counter = 0;
        $notes_counter = 0;
        $overall_students = array();

        foreach($courses as $course){

            $students = $course->users()->where('role', 'student')->get();
            $students_counter += $students->count();
            // $students = (array) $students;
            array_push($overall_students, $students);

            $notes = $course->notes()->count();
            $notes_counter += $notes;
        }

        // return dd($overall_students);

        return view('dashboards/instructor/home')->with([
            'courses' => $courses,
            'students_no' => $students_counter,
            'no_notes' => $notes_counter,
            'overall_students' => $students,
        ]);
    }

    // Return all courses/Modules assigned to a particular instructor
    public function showCourses(){

        $instructor = Auth::user();
        $date_sort = Carbon::now();

        return view('dashboards/instructor/show_courses')->with([ 
                        'instructor' => $instructor,
                        'date_sort' => $date_sort,
                    ]);
    
    }

    //  Return course details and view to add materials
    public function courseSpace($id) {

        $course = Course::find($id);
        $students = $course->users()->where('role', 'student')->count();

        return view('dashboards/instructor/course_space')->with([
            'course' => $course,
            'students' => $students,
        ]);
    }

    // Return a page to add course Materials
    public function addMaterial($course_name, $id){

        return view('dashboards/instructor/add_material')->with([
            'course_id' => $id,
            'course_name' => $course_name
        ]);
    }

    // Store the instance of notes to the database
    public function storeMaterials(Request $request, $id) {

        $request->validate([
            'title' => 'required',
            'notes' => 'required',
        ]);

        $materials = new Note;
        $materials->title = $request->title;
        $materials->notes = $request->notes;
        $materials->course_id = $id;
        $materials->user_id = Auth::id();
        $materials->save();
        

        /**
         * 
         *  Email Notification will be sent to all students taking particular course
         *  After materials being uploaded by the instructor.
         * 
         */
        if(isset($materials)){

            $course = Course::find($id);
            $students = $course->users()->where('role', 'student')->get();

            Notification::send($students, new MaterialUploaded($materials));
        }

        return redirect()->route('course.space', ['id' => $id]);
    }

    // Show single instance of the notes
    public function showNotes($id){

        $notes = Note::find($id);
    
        return view('dashboards/instructor/show_notes')->with([
            'notes' => $notes,
        ]);

    }


    public function showUpload($course){

        $course = Course::find($course);
        return view('dashboards/instructor/upload_files')->with([
            'course' => $course,
        ]);
    }

    // Function to Upload Documents
    public function storeDocs(Request $request, $id){


        // $request->validate([
        //     'description' => 'required',
        //     'file' => 'required|mimes:mp4,avi,pdf,docx,xls,webm,mpg,3gp,mp3,ppt,pptx,txt|max:5120',
        // ]);

        //  return dd($request->file);

        if($request->file('file')){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('materials', $fileName, 'public');
        }

        DB::table('documents')->insert([
            'description' => $request->description,
            'file' => "/storage/".$filePath,
            'course_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('course.space', ['id' => $id]);

        }

        // Show form to add quiz
        public function addQuiz($id){

            $notes = Note::find($id);

            return view('dashboards/instructor/add_quiz')->with([
                'notes' => $notes,
            ]);
        }

        // Store quiz
        public function storeQuiz(Request $request, $id){

            $notes = Note::find($id);
        
            $request->validate([
                'question_statement' => 'required',
                'answer' => 'required',
                'choices.*.choice' => 'required',
                'choices.*.letter' => 'required',
            ]);

            $question_exists = DB::table('questions')->where([
                ['question_statement', $request->question_statement],
                ['note_id', $id],
            ])->get();

            if($question_exists->isNotEmpty()){
                return redirect()->route('add.quiz', [$notes])->with(
                    'status', 'Question already exists!',
                );
            }

            $question = new Question;
            $question->question_statement = $request->question_statement;
            $question->answer = $request->answer;
            $question->note_id = $notes->id;
            
            $possible_answers = $request->input('choices.*.choice');
            $letters = $request->input('choices.*.letter');
            $choices = array_combine($letters, $possible_answers);

            if($choices == FALSE){
                return redirect()->route('add.quiz', [$notes])->with(
                    'status', 'Make sure there are no empty values.',
                );
            }
            
            // Submit the question if the choices have no errors
            $question->save();

            foreach($choices as $key => $value){

                    $answer_choice = new AnswerChoice;
                    $answer_choice->choice = $value;
                    $answer_choice->letter = $key;
                    $answer_choice->question_id = $question->id;
                    $answer_choice->save();
                }
            

            return view('dashboards/instructor/show_notes')->with([
                'notes' => $notes,
            ]);
        }

        public function showQuiz($id){

            $notes = Note::find($id);
            $questions = Question::where('note_id', $id)->get();

            return view('dashboards/instructor/show_quiz')->with([
                'notes' => $notes,
                'questions' => $questions,
            ]);

        }

        public function studentsEvaluation($note_id){

            $notes = Note::find($note_id);
            $course = Course::where(['id' => $notes->course_id])->first();
            $students = $course->users()->where('role', 'student')->get();
            $questions = Question::where('note_id', $note_id)->get();
            $submitted_quiz = QuizSubmission::where(['note_id' => $note_id])->get();


            return view('dashboards/instructor/student_list')->with([
                'students' => $students,
                'course' => $course,
                'notes' => $notes,
                'questions' => $questions,
                'submitted_quiz' => $submitted_quiz,
            ]);
        }
    
}
