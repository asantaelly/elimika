@extends('dashboards.instructor.index')

@section('content')
<div class="row">
    <div class="col-2"></div>
    <div class="col-md-8">

        {{-- Button to add Quizes --}}
        <div class="row">

                <a href="{{ route('add.quiz', [ 'id'=> $notes->id])}}" class="btn btn-primary mx-1">
                    <span class="fas fa-plus-circle"></span>  Add Question
                </a>

                <a href="{{ route('students.evaluation', [ 'id'=> $notes->id])}}" class="btn btn-success mx-1">
                    <span class="fas fa-eye"></span> Assesment Evaluation
                </a>

                <a href="{{ route('show.quiz', [ 'id'=> $notes->id])}}" class="btn btn-secondary mx-1">
                    <span class="fas fa-vial"></span> Go to quiz 
                </a>

        </div>
        

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

        {{-- <div class="col">
            <a href="{{ route('show.quiz', [ 'id'=> $notes->id])}}" class="btn btn-secondary">
                <span class="fas fa-vial"></span> Go to quiz 
            </a>
       </div> --}}
    </div>  
</div>
@endsection
                                                                                                                                                                                                                                             