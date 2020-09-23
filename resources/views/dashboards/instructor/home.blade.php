@extends('dashboards.instructor.index')

@section('content')


<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body text-center">
                <div class="card-title">Number of Assigned Course(s)</div>
                <div class="card-text">{{ $courses->count() }}</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body text-center">
                <div class="card-title">Number of Student(s)</div>
                <div class="card-text">{{ $students_no }}</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body text-center">
                <div class="card-title">Number of Notes Provided</div>
                <div class="card-text">{{ $no_notes }}</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body text-center">
                <div class="card-title">Number of Notes Provided</div>
                <div class="card-text">{{ $no_notes }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header text-center">
        <i class="fas fa-users mr-1"></i>
        List of Students
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Start date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Start date</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach($overall_students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ 'Male' }}</td>
                        <td>{{ $student->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
