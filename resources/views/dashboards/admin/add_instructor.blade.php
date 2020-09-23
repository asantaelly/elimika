@extends('dashboards.admin.index')

@section('content')

<div class="row ">
    <div class="col-xl-12 col-md-6 text-center">
        <h4 class="mb-4"> ADD NEW INSTRUCTOR</h4>
    </div>
</div>

<div class=" card border-primary mb-4">
    <form method="POST" action="{{ route('store_instructor') }}" class="mb-4 ml-3 mt-3 mr-3">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName">Name</label>
            <input type="name" name="name" class="form-control" id="inputName">
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Password</label>
          <input type="password" name="password" class="form-control" id="inputAddress" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="inputAddress2">Address</label>
          <input type="text" name="address" class="form-control" id="inputAddress2" placeholder="Address">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">Mobile Number</label>
            <input type="number" name="mobile_number" class="form-control" id="inputCity">
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">Gender</label>
            <select id="inputState" name="gender" class="form-control">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">Professional</label>
            <input type="text" name="professional" class="form-control" id="inputZip">
          </div>
        </div>
        <button type="submit"   class="btn btn-primary">Register Instructor</button>
      </form>
</div>
@endsection