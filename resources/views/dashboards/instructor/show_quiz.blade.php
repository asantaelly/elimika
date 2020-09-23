@extends('dashboards.instructor.index')

@section('content')

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
    <h5 class="mb-2 h4"> Quiz</h5>
    <h5 class="mb-4"><strong>{{ ucfirst($notes->title)}}</strong></h5>
    </div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-md-8">
        @if($questions->isEmpty())
            <div class="alert alert-warning">
                There are no questions in these notes!
            </div>
        @else

        @foreach($questions as $index => $question)
            <div class="card border-0" style="font-size: 123%; font-family: 'Quicksand', serif;">
                <div class="card-body">                                                                                                                                                                                                                                   
                <div class=" card-title text-left mb-2">
                    <div class="row">
                        <span class="mr-4">
                            {{ ($index+1).'.' }}
                        </span>
                        <h5>
                            {{ $question->question_statement}}
                        </h5>
                    </div>
                </div>
                
                <div class="card-text"> 
                        <div class="row ml-4">

                            @if($question->answer_choice->isEmpty())
                                <div  class="col-md-8">
                                    <span class="mr-4 alert alert-warning">
                                        There are no choices.
                                    </span>
                                    </span>
                                </div>
                            @else

                            <div  class="col-md-6">
                                @foreach($question->answer_choice as $choice)
                                    <div class="row">
                                        <div class="col-lg-1">
                                            <span class="mr-4">
                                                {{($choice->letter).'.'}}
                                            </span>
                                        </div>
                                        <div class="col-lg-11 pl-0 pl-lg-0" >
                                            <span>
                                                {{ $choice->choice}}
                                            </span>
                                        </div>   
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <span class="alert alert-success">Answer: {{ $question->answer}} </span>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="row">
                                    <div class="col-lg-4 pl-0">
                                        update
                                    </div>
                                    <div class="col-lg-4 pl-0">
                                        delete
                                    </div>
                                </div>
                            </div> --}}
                            @endif
                            
                        </div>
                </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>  
</div>
@endsection
                                                                                                                                                                                                                                             