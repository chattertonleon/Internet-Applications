@extends('layouts.app')
@section('content')
@unless(auth()->user()->isAdmin)
<h1>You are not authorised to access this area</h1>
@else
<link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Lost items</div>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><br />
          @endif
          <!-- display the success status -->
          @if (\Session::has('success'))
          <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
          </div><br />
          @endif
          <form class="form-horizontal" enctype="multipart/form-data" method="POST"
          action="{{action('ImagesController@update',$id)}}">
            @method('PATCH')
            @csrf
            <div class="col-md-8">
              <label>Upload Image(s) (less than 2MB)</label></br>
              <input type="file" name="images[]" class="form-control" placeholder="address" multiple>
            </div>
            <div class="col-md-6 col-md-offset-4">
              <input type="submit" class="btn btn-primary"/>
              <input type="reset" class="btn btn-primary"/>
            </div>
          </form>
          <table class="table table-striped">
            <tbody>
              @if(!is_null($images))
              @foreach($images as $image)
              <tr class="col-12">
                <td><img width="30%" src="{{asset('storage/images/'. $image->image)}}" alt="Image not found"></td>
                <td>
                  <form action="{{action('ImagesController@destroy',$image->id)}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endsection
