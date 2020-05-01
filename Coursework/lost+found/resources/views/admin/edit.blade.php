@extends('layouts.app')
@section('content')
@unless(auth()->user()->isAdmin)
<h1>You are not authorised to access this area</h1>
@else
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10 ">
      <div class="card">
        <div class="card-header">Edit an item entry</div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul> @foreach ($errors->all() as $error)
            <li>{{ $error }}</li> @endforeach
          </ul>
        </div><br />
        @endif
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div><br />
        @endif
        <div class="card-body">
          <form class="form-horizontal" enctype="multipart/form-data" method="POST"
          action="{{action('ItemsController@update',$item['id'])}}" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          <table class='col-12'>
            <tbody>
              <tr>
                <th>Detail to change</th>
                <th>Current Value</th>
                <th>New Value</th>
              </tr>
              <tr>
                <td>Category</td>
                <td>{{$item['category']}}</td>
                <td>
                  <select name="category" value="{{$item->category}}">
                    <option value="pet">Pet</option>
                    <option value="phone">Phone</option>
                    <option value="jewellery">Jewellery</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Color</td>
                <td>{{$item['color']}}</td>
                <td><input type="text" name="color" placeholder="Color of item" value="{{$item->color}}"/></td>
              </tr>
              <tr>
                <td>Date found</td>
                <td>{{$item['date_found']}}</td>
                <td><input type="date" name="date_found" placeholder="Date item lost" value="{{$item->date_found}}"></td>
              </tr>
              <tr>
                <td>Description</td>
                <td>{{$item['details']}}</td>
                <td><textarea name="details" rows="8" class="col-md-8" placeholder="Describe the item" value="{{$item->details}}"></textarea></td>
              </tr>
              <tr>
                <td>Location</td>
                <td>{{$item['place']}}</td>
                <td><input type="text" name="place" placeholder="Location found" value="{{$item->place}}"></td>
              </tr>
            </tbody>
          </table>
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
@endif
@endsection
