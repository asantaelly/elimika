@extends('dashboards.admin.index')

@section('content')

    
    
    <div class="">
        <h6 class="text-center h3">ASSIGN INSTRUCTOR TO A PARTICULAR COURSE</h6>
    </div>


    <div class="table-responsive col-8">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">NAME</th>
                    <td class="font-weight-bold"><b>{{ ucfirst($course->course_name)}}</b></td>
                </tr>
                <tr>
                    <th scope="row">DESCRIPTION</th>
                    <td class="font-weight-bold"><b>{{ $course->course_description}}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
        
    &nbsp;
        
    <div class="card border-info mb-4">
        <div class="card-header text-white text-center" style="background-color: #007bff">
            <h5>List of Available Instructors</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profession</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($trainers))
                            <tr>
                                <h3 class="text-center">Oops! No Instructors found!</h3>
                            </tr>
                        @endif
    
                        @if($course->users()->where('role', 'instructor')->get())


                        @foreach($course->users()->where('role', 'instructor')->get() as $trainer)
                            <tr>
                                <td>
                                    <a href="{{ route('show_instructor', [ 'id' => $trainer->id])}}">
                                        {{ ucfirst($trainer->name)}}
                                    </a>
                                </td>
                                <td>{{ $trainer->email}}</td>
                                <td>{{ $trainer->instructor->professional ?? 'Not available'}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm">
                                            <form action="{{ route('assign_instructor')}}" method="POST">

                                                <input type="hidden" name="course_id" value="{{ $course->id}}">
                                                <input type="hidden" name="trainer_id" value="{{ $trainer->id}}">
                                                @csrf
                                                <button class="btn btn-info btn-sm" disabled>Assigned</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @else
                        @foreach($trainers as $trainer)
                            <tr>
                                <td>
                                    <a href="{{ route('show_instructor', [ 'id' => $trainer->id])}}">
                                        {{ ucfirst($trainer->name)}}
                                    </a>
                                </td>
                                <td>{{ $trainer->email}}</td>
                                <td>{{ $trainer->instructor->professional ?? 'Not available'}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm">
                                            <form action="{{ route('assign_instructor')}}" method="POST">

                                                <input type="hidden" name="course_id" value="{{ $course->id}}">
                                                <input type="hidden" name="trainer_id" value="{{ $trainer->id}}">
                                                @csrf
                                                <button class="btn btn-info btn-sm">Assign Course</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
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
