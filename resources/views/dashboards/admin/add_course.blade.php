@extends('dashboards.admin.index')

@section('content')

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
        <h4 class="mb-4"> ADD NEW COURSE</h4>
    </div>
</div>

<div class=" card border-primary mb-4">
    <form method="POST" action="{{ route('store_course')}}" class="mb-4 ml-3 mt-3 mr-3">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Course Name</label>
            <div class="col-sm-8">
              <input type="text" name="course_name" class="form-control @error('name') is-invalid @enderror" id="course_name" placeholder="Course Name">

                @error('course_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="inputDesc" class="col-sm-2 col-form-label">Course Description...</label>
            <div class="col-sm-8">
              <textarea type="text" name="course_description" class="form-control @error('description') is-invalid @enderror" id="inputDesc" placeholder="Course Description"></textarea>

                @error('course_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>

        <button type="submit"   class="btn btn-primary">ADD NEW COURSE</button>
      </form>
</div>
@endsection