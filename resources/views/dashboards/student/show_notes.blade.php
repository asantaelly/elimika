@extends('dashboards.student.index')

@section('content')

@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
@endif

<div class="row">
    <div class="col-2">
        {{-- <a href="{{ route('show.quiz.student', [ 'id'=> $notes->id])}}" class="btn btn-primary">
            Go to quiz 
        </a> --}}
    </div>
    <div class="col-md-8">

        <a href="{{ route('show.quiz.student', [ 'id'=> $notes->id])}}" class="btn btn-outline-secondary">
            <span class="fas fa-vial"></span> Go to quiz 
        </a>

        <div class="card border-0" style="font-size: 123%; font-family: 'Quicksand', serif;">
            <div class="card-body">                                                                                                                                                                                                                                   
            <div class=" card-title text-center">
                <h3>
                    {{ $notes->title}}
                </h3>
            </div>
            &nbsp;
            <div class="card-text"> {!! $notes->notes !!}</div>
            </div>
        </div>

        {{-- @if($quiz_submitted == FALSE) --}}
        <div class="col">
            
       </div>
       {{-- @endif --}}

    </div>  
</div>
@endsection
