@extends('dashboards.instructor.index')

@section('content')

    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
    <h5 class="mb-4"> Add Question to <strong>{{ ucfirst($notes->title)}}</strong></h5>
    </div>
</div>

<div class=" card border-primary mb-4">
    <form method="POST" action="{{ route('store.quiz', [ 'id' => $notes->id])}}" class="mb-4 ml-3 mt-3 mr-3">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Question</label>
            <div class="col-sm-8">
              <textarea name="question_statement" class="form-control @error('question_statement') is-invalid @enderror" id="question" placeholder="Question..."></textarea>

                @error('question_statement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>



        {{-- First Choice --}}
        <div class="form-group row">
            <label for="inputDesc" class="col-sm-2 col-form-label">Choices</label>
            <div class="col-sm-8">
                <div class="form-row">

                        <div class="form-group col-md-2">
                            <label for="inputChoiceLetter">Letter</label>
                            <select name="choices[1][letter]" id="inputLetter" class="form-control">
                                <option value="A" selected>A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                {{-- <option value="D">D</option>
                                <option value="E">E</option> --}}
                            </select>

                            @error('choice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-10">
                            <label for="inputChoice">Choice</label>
                            <input type="text" id="" name="choices[1][choice]" class="form-control @error('description') is-invalid @enderror" id="inputDesc" placeholder="Choice">

                            @error('choice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{-- Second Choice --}}
                        <div class="form-group col-md-2">
                            <label for="inputChoiceLetter">Letter</label>
                            <select name="choices[2][letter]" id="inputLetter" class="form-control">
                                <option value="A">A</option>
                                <option value="B" selected>B</option>
                                <option value="C">C</option>
                                {{-- <option value="D">D</option>
                                <option value="E">E</option> --}}
                            </select>

                            @error('choice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-10">
                            <label for="inputChoice">Choice</label>
                            <input type="text" id="" name="choices[2][choice]" class="form-control @error('description') is-invalid @enderror" id="inputDesc" placeholder="Choice">

                            @error('choice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Third Choice --}}
                        <div class="form-group col-md-2">
                            <label for="inputChoiceLetter">Letter</label>
                            <select name="choices[3][letter]" id="inputLetter" class="form-control">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C" selected>C</option>
                                {{-- <option value="D">D</option>
                                <option value="E">E</option> --}}
                            </select>

                            @error('choice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-10">
                            <label for="inputChoice">Choice</label>
                            <input type="text" id="" name="choices[3][choice]" class="form-control @error('description') is-invalid @enderror" id="inputDesc" placeholder="Choice">

                            @error('choice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                </div>     
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Answer</label>
            <div class="col-md-2">
                    <select name="answer" id="inputLetter" class="form-control">
                        <option value="A" selected>A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        {{-- <option value="D">D</option>
                        <option value="E">E</option> --}}
                    </select>
            
                @error('answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        
          <div class="text-center">
            <button type="submit"   class="btn btn-primary"> + Add Question</button>
          </div>
      </form>
</div>
@endsection