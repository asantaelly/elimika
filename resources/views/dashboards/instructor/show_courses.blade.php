@extends('dashboards.instructor.index')

@section('content')

    <div class="card border-info mb-4">
        <div class="card-header text-white text-center" style="background-color: #007bff">
            <h5>List of Courses Assigned to Instructor</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($instructor->courses->isEmpty())
                            <tr>
                                <h3 class="text-center">Oops! No courses found!</h3>
                            </tr>
                        @endif
    
                        @foreach($instructor->courses as $course)
                            <tr>
                                <td>
                                    <a href="{{ route('course.space', [ 'id' => $course->id])}}">
                                        {{ ucfirst($course->course_name)}}
                                    </a>
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
