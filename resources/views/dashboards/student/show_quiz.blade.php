@extends('dashboards.student.index')

@section('content')

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
    <h5 class="mb-1 h4">Quiz</h5>
    <h5 class="mb-4 font-weight-lighter"><strong>{{ ucfirst($notes->title)}}</strong></h5>

    </div>
</div>

@if($quiz_submitted == TRUE)
    <div class="row ">
        <div class="col-xl-12 col-md-6 text-center">
        <h5 class="mb-4 font-weight-lighter">
        @if($submitted_quiz->where('correctness', TRUE)->count()/$questions->count() >= 0.5)

                <span class="alert alert-success">
                    Your Score: {{ $submitted_quiz->where('correctness', TRUE)->count().' out of '. $questions->count().' PASS'}}
                </span>

        @elseif($submitted_quiz->where('correctness', TRUE)->count()/$questions->count() < 0.5)

                <span class="alert alert-warning">
                    Your Score: {{ $submitted_quiz->where('correctness', TRUE)->count().' out of '. $questions->count().' FAILED'}}
                </span>
        @endif
        </h5>
        </div>
    </div>
@endif


@if(session('status'))
        <div class="alert alert-secondary">
            {{ session('status') }}
        </div>
@endif

<div class="row">
    <div class="col-2"></div>
    <div class="col-md-8">
        @if($questions->isEmpty())
            <div class="alert alert-warning">
                There are no questions in these notes!
            </div>
        @else



        {{-- Start Form --}}
        <form action="{{ route('quiz.submission', [ 'id' => $notes->id])}}" method="POST">
            @csrf
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

                        <div  class="col-md-8">
                            @foreach($question->answer_choice as $choice)
                                <div class="row">
                                    <div class="col-lg-1">
                                        <span class="mr-4">
                                            {{($choice->letter).'.'}}
                                        </span>
                                    </div>
                                    <div class="col-lg-11 pl-0">
                                        <span>
                                            {{ $choice->choice}}
                                        </span>
                                    </div>   
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-4">

                            @if ($quiz_submitted == FALSE)
                                <div class="form-group col-sm-8">
                                    <input type="hidden" name="question[{{ $question->id}}][number]" value="{{ $question->id}}">
                                    <label for="answer">Answer</label>
                                    <select name="answer[{{$index+1}}][letter]" id="inputLetter" class="form-control">
                                        <option value="" disabled selected>Choose..</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
        
                                    @error('answer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>   
                            @else

                                @if($question->quiz_submissions()->where('correctness', '=', TRUE)->value('correctness'))
                                    <div class="row">
                                        <span class="alert alert-success">{{ $question->answer }} is Correct</span>
                                    </div>
                                @elseif($question->quiz_submissions()->where('correctness', '=', FALSE)->value('correctness') == FALSE)
                                    <div class="row">
                                        <span class="alert alert-danger">{{ $question->quiz_submissions()->value('answer_chosen')}} is incorrect</span>
                                        <br>
                                        <span class="alert alert-success">Correct answer is {{ $question->answer}}</span>
                                    </div>
                                @endif

                            @endif

                                

                        </div>
                        @endif
                        
                    </div>
            </div>
            </div>
        </div>
        @endforeach
        
        @if($quiz_submitted == FALSE)
        <div class="text-left">
            <button type="submit"   class="btn btn-primary"> Submit Quiz</button>
          </div>
        </form>
        @endif
        {{-- End Form --}}
        @endif
    </div>  
</div>
@endsection
                                                                                                                                                                                                                                            