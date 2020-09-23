@extends('dashboards.admin.index')

@section('content')


<div class="row ">
    <div class="col-xl-12 col-md-6 text-left">
    <a href="{{ route('add_instructor')}}" type="button" class="btn btn-outline-dark mb-4">
        <span class="fas fa-plus-circle"></span> Add Instructor</a>
    </div>
</div>


<div class="card border-info mb-4">
    <div class="card-header text-white text-center" style="background-color: #007bff">
        <h5>List of Instructors</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Profession</th>
                        <th>Registering Date</th>
                        <th>Assigned Courses</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($trainers))
                        <tr>
                            <h3 class="text-center">Oops! No Instructors found!</h3>
                        </tr>
                    @endif

                    @foreach($trainers as $trainer)
                        <tr>
                            <td>
                                <a href="{{ route('show_instructor', [ 'id' => $trainer->id])}}">
                                    {{ ucfirst($trainer->name)}}
                                </a>
                            </td>
                            <td>{{ $trainer->email}}</td>
                            <td>{{ $trainer->gender}}</td>
                            <td>{{ $trainer->age}}</td>
                            <td>{{ $trainer->instructor->professional ?? 'Not available'}}</td>
                            <td>{{ $trainer->created_at->toFormattedDateString()}}</td>
                            <td>
                                @if($trainer->courses->isEmpty())
                                    {{ 'Not Enrolled' }}
                                @else
                                    @foreach($trainer->courses as $course)
                                            {{ $course->course_name }}
                                    @endforeach
                                @endif
                            </td>
                            {{-- <td>
                                <div class="row">
                                    <div class="col-sm">
                                        <form action="#" method="POST">
                                            @csrf
                                            <input name="status" type="hidden" value="UPDATE">
                                            <button class="btn btn-warning btn-sm">Deactivate</button>
                                        </form>
                                    </div>
                                    <div class="col-sm">
                                        <form action="#" method="POST">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </td> --}}
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