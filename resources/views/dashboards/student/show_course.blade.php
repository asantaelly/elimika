@extends('dashboards.student.student_enroll')

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
                        <th scope="row">Course Name</th>
                        <td><b>{{ ucfirst($course->course_name)}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Course Description</th>
                        <td><b>{{ $course->course_description}}</b></td>
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
        <div class="col"></div>
</div>
@endsection
