@extends('dashboards.admin.index')

@section('content')
<div class="card border-primary mb-4">
    <div class="card-header text-center text-white" style="background-color: #007bff">
        <h5>List of Students</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Course Enrolled</th>
                        <th>Registering Date</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if(empty($students))
                        <tr>
                            <h3 class="text-center">Oops! No Students found!</h3>
                        </tr>
                    @endif

                    @foreach($students as $student)
                        <tr>
                            <td>
                                <a href="{{ route('show_student', ['id' => $student->id])}}">
                                    {{ ucfirst($student->name)}}
                                </a>
                            </td>
                            <td>{{ $student->email}}</td>
                            <td>{{ $student->gender}}</td>
                            <td>{{ $student->age}}</td>
                            <td>
                                @if($student->courses->isEmpty())
                                    {{ 'Not Enrolled' }}
                                @else
                                    @foreach($student->courses as $course)
                                            {{ $course->course_name }}
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $student->created_at->toFormattedDateString()}}</td>
                            {{-- <td>
                                <div class="row">
                                    <div class="col-sm">
                                        <form action="#" method="POST">
                                            @csrf
                                            <input name="status" type="hidden" value="UPDATE">
                                            <button class="btn btn-warning btn-sm mb-1">Deactivate</button>
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