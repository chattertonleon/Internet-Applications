<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10 ">
      <div class="card">
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
        <div class="card-header">Create an new item entry</div>
        <div class="card-body">
          <form class="form-horizontal" enctype="multipart/form-data" method="POST"
          action="{{action('ClaimsController@store')}}" enctype="multipart/form-data">
          @csrf
          <div class="col-md-8">
            <label>Describe the why this claim is yours</label>
            <textarea type="text" name="reason" rows="8" class="col-md-8"></textarea>
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
@endsection
