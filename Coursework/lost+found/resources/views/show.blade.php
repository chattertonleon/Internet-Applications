@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card" id="navigation">
        <h1>Lost and Found</h1>
      </div>
      <div class="card">
        <div class="card-header">Lost items</div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul> @foreach ($errors->all() as $error)
            <li>{{ $error }}</li> @endforeach
          </ul>
        </div><br />
        @endif
        <!-- display the success status -->
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div><br />
        @endif
        <div class="card-body">
          <table class="table table-striped">
          <tbody>
            <tr>
              @if(!is_null($images))
              @foreach($images as $image)
              <td>{{$image['image']}}</td>
              @endforeach
              @else
              <td>No images found</td>
              @endif
            </tr>
            <tr>
              <td>
                <form action="{{url('items')}}"method="post">
                  @csrf
                  <input name="_method" type="hidden" value="GET">
                  <button class="btn btn-primary" type="submit">Back</button>
                </form>
              </td>
              <td>
                <form action="{{action('ClaimsController@edit',$item['id'])}}"method="post">
                  @csrf
                  <input name="_method" type="hidden" value="GET">
                  <button class="btn btn-primary" type="submit">Claim</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
