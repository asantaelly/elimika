@extends('dashboards.student.index')

@section('content')
<div class="">
    <h6 class="text-center">Course Details</h6>
</div>
<div class="row">
    <div class="col"></div>
        <div class="table-responsive col-8">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Title</th>
                        <td><b>{{ ucfirst($course->course_name)}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td><b>{{ $course->course_description}}</b></td>
                    </tr>
                    {{-- <tr>
                        <th scope="row"></th>
                        <td>
                            <div class="col-sm">
                                    <button class="btn btn-primary btn-sm">Read More...</button>
                            </div>
                        </td>
                    </tr> --}}

                </tbody>
            </table>
        </div>
        <div class="col"></div>
</div>



{{-- List of all Materials uploaded to this course--}}
&nbsp;
<div class="">
    <div class="card border-info mb-4">
        <div class="card-header text-white text-center" style="background-color: #007bff">
            <h5>List of Notes</h5>
        </div>
        <div class="card-body">
            @if($course->notes->isEmpty())
                <tr>
                    <h5 class="text-center"><strong>Oops!</strong> Wait for the notes!</h5>
                </tr>
            @else
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       
    
                        @foreach($course->notes as $notes)
                            <tr>
                                <td>
                                    <a href="{{ route('student.show.notes', [ 'id' => $notes->id])}}">
                                        {{ ucfirst($notes->title)}}
                                    </a>
                                </td>
                                {{-- <td>
                                    <div class="row">
                                        <div class="col-sm">
                                            <form action="{{ route('assign_instructor')}}" method="POST">
                                                @csrf
                                                <button class="btn btn-info btn-sm">Assign Course</button>
                                            </form>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
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
