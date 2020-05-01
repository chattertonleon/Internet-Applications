<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
@guest
<h1>You are not authorised to access this area</h1>
@else
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10 ">
      <div class="card">
        <div class="card-header">Create an new item entry</div>
        <!-- display the errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul> @foreach ($errors->all() as $error)
            <li>{{ $error }}</li> @endforeach
          </ul>
        </div><br /> @endif
        <!-- display the success status -->
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div><br /> @endif
        <!-- define the form -->
        <div class="card-body">
          <form class="form-horizontal" enctype="multipart/form-data" method="POST"
          action="{{url('items')}}" enctype="multipart/form-data">
          @csrf
          <div class="col-md-8">
            <label>Category</label></br>
            <select name="category" >
              <option value="pet">Pet</option>
              <option value="phone">Phone</option>
              <option value="jewellery">Jewellery</option>
            </select>
          </div>
          <div class="col-md-8">
            <label>Color</label></br>
            <input type="text" name="color"
            placeholder="Color of item" />
          </div>
          <div class="col-md-8">
            <label>Date found</label></br>
            <input type="date" name="date_found"
            placeholder="Date item lost">
          </div>
          <div class="col-md-8">
            <label>Description</label></br>
            <textarea name="details" rows="8" class="col-md-8" placeholder="Describe the item">
            </textarea>
          </div>
          <div class="col-md-8">
            <label>Location</label></br>
            <input type="text" name="place" placeholder="Location found">
          </div>
          <div class="col-md-8">
            <label>Upload Image(s)</label></br>
            <input type="file" name="images[]" class="form-control" placeholder="address" multiple>
          </div>
          <div class="col-md-6 col-md-offset-4">
            <input type="submit" class="btn btn-primary" />
            <input type="reset" class="btn btn-primary" />
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endguest
@endsection
