@extends('dashboards.student.index')

@section('content')

<div class="row mt-5">
    <div class="col"></div>

        <div class="card">
            <div class="card-body">



                <div class="">
                    <h6 class="text-center">Course Details</h6>
                </div>


                {{-- Start Table --}}
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Course Name</th>
                                <td><b>{{ ucfirst($course->course_name)}}</b></td>
                            </tr>
                            <tr>
                                <th scope="row">Course Description</th>
                                <td class=""><b>{{ $course->course_description}}</b></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="col-sm">
                                        <form action="{{ route('store.user.course', [ 'id' => $course->id])}}" method="POST">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">Course Enrollment</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
        
                        </tbody>
                    </table>
                </div>
                {{-- End Table --}}

            </div>
        </div>

        
        <div class="col"></div>
</div>
@endsection
