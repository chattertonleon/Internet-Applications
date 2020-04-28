@extends('layouts.app')
@section('content')
@unless(auth()->user()->isAdmin)
<h1>You are not authorised to access this area</h1>
@else
<link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card" id="navigation">
        <h1>Lost and Found</h1>
      </div>
      <div class="card">
        <div class="card-header">View claims requests</div>
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
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Category</th>
                <th>Color</th>
                <th>Date Lost</th>
                <th>Reason Given</th>
              </tr>
            </thead>
            <tbody>
              @foreach($claims as $claim)
              <tr>
                <td>{{$claim->category}}</td>
                <td>{{$claim->color}}</td>
                <td>{{$claim->date_lost}}</td>
                <td>{{$claim->reason}}</td>
                <td>
                  <form action="{{action('ItemsController@edit',$claim->id)}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <button class="btn btn-primary" type="submit">Accept</button>
                  </form>
                </td>
                <td>
                  <form action="{{action('ClaimsController@destroy',$claim->id)}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Reject</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endif
@endsection
