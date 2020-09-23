@extends('dashboards.student.index')

@section('content')

{{-- <div class="row">

            @foreach($courses as $course)
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">{{ $course->course_name}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('read.course', [ 'id' => $course->id])}}">
                                Continue to read!
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach
</div> --}}

@extends('dashboards.instructor.index')

@section('content')

    <div class="card border-info mb-4">
        <div class="card-header text-white text-center" style="background-color: #007bff">
            <h5>List of Courses Enrolled</h5>
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
                        {{-- @if($instructor->courses->isEmpty())
                            <tr>
                                <h3 class="text-center">Oops! No courses found!</h3>
                            </tr>
                        @endif --}}
    
                        @foreach($courses as $course)
                            <tr>
                                <td>
                                    <a href="{{ route('read.course', [ 'id' => $course->id])}}">
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

@endsection