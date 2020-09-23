@extends('dashboards.instructor.index')

@section('content')

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
    <h5 class="mb-2 h4"><strong>{{ $course->course_name }}</strong></h5>
    <h5 class="mb-4 h5">{{ $notes->title }}</h5>
    </div>
</div>

    <div class="card border-info mb-4">
        <div class="card-header text-white text-center" style="background-color: #007bff">
            <h4> List of Students</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Quiz Evalutation</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($students->isEmpty())
                            <tr>
                                <h3 class="text-center">No registered students!</h3>
                            </tr>
                        @endif
    
                        @foreach($students as $student)
                            <tr>
                                <td>
                                    {{ $student->name}}
                                </td>
                                <td>
                                    
                                    @if($student->quiz_submissions()->where(['note_id' => $notes->id, 'correctness' => TRUE])->get()->isEmpty())
                                        Not Attempted
                                    @else
                                        {{ $student->quiz_submissions()->where(['note_id' => $notes->id, 'correctness' => TRUE])->count().'/'. $questions->count()}}
                                    @endif
                                </td>
                                <td>


                                    @if($student->quiz_submissions()->where(['note_id' => $notes->id, 'correctness' => TRUE])->get()->isEmpty())
                                        <span class="alert alert-warning">Not Attempted</span>
                                    @else
                                        @if($student->quiz_submissions()->where(['note_id' => $notes->id, 'correctness' => TRUE])->count()/$questions->count() >= 0.5)
                                        <span class="alert alert-success">PASS</span>
                                        @elseif($student->quiz_submissions()->where(['note_id' => $notes->id, 'correctness' => TRUE])->count()/$questions->count() < 0.5)
                                            <span class="alert alert-danger">FAILED</span>
                                        @endif
                                    @endif

                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        

    <style>
        a:link {
        color: black;
        background-color: transparent;
        text-decoration: none;
        }

        a:visited {
        color: black;
        background-color: transparent;
        text-decoration: none;
        }

        a:hover {
        color: blue;
        background-color: transparent;
        text-decoration: none;
        }

        a:active {
        color: black;
        background-color: transparent;
        text-decoration: none;
        }
    </style>
@endsection
