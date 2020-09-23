@extends('dashboards.admin.index')

@section('content')
<div class="">
    <h6 class="text-center">STUDENT PROFILE</h6>
</div>
<div class="row">
    <div class="col"></div>
        <div class="table-responsive col-8">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td><b>{{ ucfirst($student->name)}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><b>{{ $student->email}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Registered Date</th>
                        <td><b>{{ $student->created_at->toFormattedDateString()}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td><b>{{ $student->gender}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Mobile Number</th>
                        <td><b>{{ $student->mobile_number}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Address</th>
                        <td><b>{{ $student->address}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Courses Enrolled</th>
                        <td>
                            <b>
                                @if($student->courses->isEmpty())
                                    {{ 'Not Enrolled' }}
                                @else
                                    @foreach($student->courses as $course)
                                            {{ $course->course_name }}
                                    @endforeach
                                @endif
                            </b>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col"></div>
</div>
@endsection
