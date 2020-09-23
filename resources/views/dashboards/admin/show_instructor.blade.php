@extends('dashboards.admin.index')

@section('content')
<div class="">
    <h6 class="text-center">INSTRUCTOR PROFILE</h6>
</div>
<div class="row">
    <div class="col"></div>
        <div class="table-responsive col-8">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td><b>{{ ucfirst($trainer->name)}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><b>{{ $trainer->email}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Registered Date</th>
                        <td><b>{{ $trainer->created_at->toFormattedDateString()}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td><b>{{ $trainer->gender}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Mobile Number</th>
                        <td><b>{{ $trainer->mobile_number}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Address</th>
                        <td><b>{{ $trainer->address}}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Profession</th>
                        <td><b>{{ $trainer->instructor->professional ?? 'Not available' }}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Courses assigned</th>
                        <td><b>
                            @if($trainer->courses->isEmpty())
                                    {{ 'Not Enrolled' }}
                                @else
                                    @foreach($trainer->courses as $course)
                                            {{ $course->course_name }}
                                    @endforeach
                                @endif    
                        </b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col"></div>
</div>
@endsection
