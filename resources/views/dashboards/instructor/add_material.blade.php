@extends('dashboards.instructor.index')

@section('content')

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
    <h5 class="mb-4"> Add materials to <strong>{{ ucfirst($course_name)}}</strong></h5>
    </div>
</div>

<div class=" card border-primary mb-4">
    <form method="POST" action="{{ route('store.materials', [ 'id' => $course_id])}}" class="mb-4 ml-3 mt-3 mr-3">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Title of the topic</label>
            <div class="col-sm-8">
              <input type="text" name="title" class="form-control @error('name') is-invalid @enderror" id="course_name" placeholder="Title">

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="inputDesc" class="col-sm-2 col-form-label">Topic Notes</label>
            <div class="col-sm-8">
              <textarea type="text" id="editor" name="notes" class="form-control @error('description') is-invalid @enderror" id="inputDesc" placeholder="Notes"></textarea>

                @error('notes')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
        
          <div class="text-center">
            <button type="submit"   class="btn btn-primary"> + Add Materials</button>
          </div>
      </form>
</div>
@endsection