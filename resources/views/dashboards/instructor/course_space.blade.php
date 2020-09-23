@extends('dashboards.instructor.index')

@section('content')

<div class="">
    {{-- <h6 class="text-center">Course Description</h6> --}}
</div>


<div class="table-responsive col-8">
    <table class="table">
        <tbody>
            <tr>
                <th scope="row">TITLE</th>
                <td class="font-weight-bold"><b>{{ ucfirst($course->course_name)}}</b></td>
            </tr>
            <tr>
                <th scope="row">DESCRIPTION</th>
                <td class="font-weight-bold"><b>{{ $course->course_description}}</b></td>
            </tr>
            <tr>
                <th scope="row">STUDENT(S)</th>
                <td class="font-weight-bold"><b>{{ $students }}</b></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row">

    {{-- Button to upload documents --}}
    {{-- <div class="col text-left"> --}}
        <a  href="{{ route('upload.files', [$course])}}" class="btn btn-outline-success mx-1">
            <span class="fas fa-cloud-upload-alt"></span> Upload Documents
        </a>
    {{-- </div> --}}



    {{-- <div class="col text-right"> --}}
        
       {{-- Button to add materials --}}
       {{-- <div class="col"> --}}
            <a href="{{ route('add.materials', [ 'id' => $course->id, 'course_name' => $course->course_name])}}" class="btn btn-outline-dark mx-1">
                <span class="fas fa-plus-circle"></span> Add Materials
            </a>
       {{-- </div> --}}
    {{-- </div> --}}
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
                    <h5 class="text-center"><strong>Oops!</strong> You didn't provide notes!</h5>
                </tr>
            @else
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                       
    
                        @foreach($course->notes as $notes)
                            <tr>
                                <td>
                                    <a href="{{ route('show.notes', [ 'id' => $notes->id])}}">
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
        color: #007bff;
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
