@extends('dashboards.instructor.index')

@section('content')

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
    <h5 class="mb-4"> Upload Documents to <strong>{{ ucfirst($course->course_name)}}</strong></h5>
    </div>
</div>

<div class=" card border-primary mb-4">
    <form method="POST" action="{{ route('store.docs', [$course->id])}}" class="mb-4 ml-3 mt-3 mr-3" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-8">
              <input type="text" name="description" class="form-control @error('name') is-invalid @enderror" id="course_name" placeholder="Description">

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="fileInput" class="col-sm-2 col-form-label">Upload file</label>
            <div class="col-sm-8">
                <input type="file" class="form-control-file" name="file" id="">


                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>

        
          <div class="text-center">
            <button type="submit"   class="btn btn-primary"><span class="fas fa-cloud-upload-alt"></span> Upload Documents</button>
          </div>
      </form>
</div>
@endsection