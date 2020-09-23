@extends('dashboards.admin.index')

@section('content')


<div class="row ">
    <div class="col-xl-12 col-md-6 text-left">
    <a href="{{ route('add_course')}}" type="button" class="btn btn-outline-dark mb-4"><span class="fas fa-plus-circle"></span> AddCourse</a>
    </div>
</div>


<div class="card border-info mb-4">
    <div class="card-header text-white text-center" style="background-color: #007bff">
        <h5>List of Courses</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Registering Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($courses))
                        <tr>
                            <h3 class="text-center">Oops! No courses found!</h3>
                        </tr>
                    @endif

                    @foreach($courses as $course)
                        <tr>
                            <td>
                                <a href="{{ route('assign_course', [ 'id' => $course->id])}}">
                                    {{ ucfirst($course->course_name)}}
                                </a>
                            </td>
                            <td>{{ $course->created_at->toFormattedDateString()}}</td>
                            <td>
                                <div class="row">
                                        <form action="#" method="POST">
                                            @csrf
                                            <input name="status" type="hidden" value="UPDATE">
                                            <button class="btn btn-success btn-sm mx-1" disabled>Update</button>
                                        </form>
                                        <form action="#" method="POST">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger btn-sm mx-1" disabled>Delete</button>
                                        </form>
                                    
                                </div>
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