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
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Category</th>
                <th>Date Found</th>
                <th>Reason For Claim</th>
                <th>Claim Status</th>
              </tr>
            </thead>
            <tbody>
              @guest
              @else
              @foreach($claims as $claim)
              <tr>
                <td>{{$claim['category']}}</td>
                <td>{{$claim['date_found']}}</td>
                <td>{{$claim['claim_reason']}}</td>
                <td>{{$claim['claim_status']}}</td>
              </tr>
              @else
              <tr>
                <td>{{$claim['category']}}</td>
                <td>{{$claim['date_found']}}</td>
                <td>{{$claim['claim_reason']}}</td>
                <td>{{$claim['claim_status']}}</td>
              </tr>
              @endguest
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
