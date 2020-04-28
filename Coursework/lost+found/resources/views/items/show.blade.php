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
          <thead>
            <tr>
              <th>Details</th>
              <th>Place Found</th>
              <th>Images</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @if(!is_null($item['details']))
              <td>{{$item['details']}}</td>
              @else
              <td>No details given</td>
              @endif
              @if(!is_null($item['place']))
              <td>{{$item['place']}}</td>
              @else
              <td>No place given</td>
              @endif
              <td>
                <form action="{{action('ImagesController@show',$item['id'])}}"method="post">
                  @csrf
                  <input name="_method" type="hidden" value="GET">
                  <button class="btn btn-primary" type="submit">View</button>
                </form>
              </td>
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
