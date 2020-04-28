@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-10 ">
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
                <th>Category</th>
                <th>Color</th>
                <th>Date Found</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
              @if(empty($item['claimed_user_id']))
              @guest
              <tr>
                <td>{{$item['category']}}</td>
                <td>{{$item['color']}}</td>
                <td>{{$item['date_found']}}</td>
              </tr>
              @else
              <tr>
                <td>{{$item['category']}}</td>
                <td>{{$item['color']}}</td>
                <td>{{$item['date_found']}}</td>
                <td>
                  <form action="{{action('ItemsController@show',$item['id'])}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <button class="btn btn-primary" type="submit">More Info</button>
                  </form>
                </td>
                @if (auth()->user()->isAdmin == 0)
                <td>
                  <form action="{{action('ClaimsController@edit',$item['id'])}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <button class="btn btn-primary" type="submit">Claim</button>
                  </form>
                </td>
                @else
                <td>
                  <form action="{{action('AdminController@edit',$item['id'])}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <button class="btn btn-primary" type="submit">Update</button>
                  </form>
                </td>
                <td>
                  <form action="{{action('ImagesController@edit',$item['id'])}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <button class="btn btn-primary" type="submit">Edit Images</button>
                  </form>
                </td>
                <td>
                  <form action="{{action('ItemsController@destroy',$item['id'])}}"method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
                </td>
                @endif
              </tr>
              @endif
              @endguest
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
