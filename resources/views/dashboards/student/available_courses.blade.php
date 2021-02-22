@extends('dashboards.student.index')

@section('content')

<div class="container-fluid">


        <h4 class="mt-4">
            List of Available Courses
        </h4>
        <hr class="my-4" />

        <div class="row">
            @foreach($courses as $course)
                <div class="col-xl-3 col-md-6">
                    <div class="card text-dark border-info mb-4">
                        <div class="card-body">
                        <div class="card-title">{{ $course->course_name}}</div>
                        <div class="card-text d-flex align-items-center justify-content-between">
                            <a class="small stretched-link" href="{{ route('show.course', [ 'id' => $course->id])}}">
                                View Course Details
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    
@endsection