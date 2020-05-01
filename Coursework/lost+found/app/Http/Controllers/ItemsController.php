<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Image;
use App\Claims;
use \DB;
use \Auth;

class ItemsController extends Controller
{
  /**
  * Display a listing of an item
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $items = Item::all()->toArray();
    $claims = Claims::all()->toArray();
    if (Auth::check() && $claims != null){
      //Will show a logged in user all items but the ones they have claimed
      foreach($claims as $claim){
        if ($claim['user_id'] == auth()->user()->id){
          foreach ($items as $item) {
            if ($item['id'] == $claim['item_id']){
              $key = array_search($item, $items);
              unset($items[$key]);
            }
          }
        }
      }
    }
    return view('items.index',compact('items'));
  }

  /**
  * Show the form for creating a item
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('items.create');
  }

  /**
  * Store a newly created item in the database
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // form validation
    $this->validate(request(),[
      'category' => 'required',
      'color' => 'required',
      'date_found' => 'required|before:tomorrow',
      'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2000'
    ],[
      'images.*.required' => 'An image is required to be uploaded to the server',
      'images.*.image' => 'All files uploaded must be an image',
      'images.*.mimes' => 'All images uploaded must be of type jpeg,png,jpg,gif or svg',
      'images.*.max' => 'All images uploaded must be less than 2MB each'
    ]);

    $item = new Item;
    $item->category = $request->input('category');
    $item->color = $request->input('color');
    $item->date_found = $request->input('date_found');
    $item->details = $request->input('details');
    $item->place = $request->input('place');
    $item->save();
    if ($request->hasFile('images')){
      $files=$request->file('images');
      foreach($files as $file){
        $fileNameWithExt=$file->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        $path = $file->storeAs('public/images',$fileNameToStore);
        $newImage = new Image;
        $newImage->image = $fileNameToStore;
        $newImage->image_item_id = $item->id;
        $newImage->save();
      }
    }
    return back()->with('success', 'Item has been added');
  }

  /**
  * Display the an item and it's further details
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $item = Item::find($id);
    return view('items.show',compact('item'));
  }

  /**
  *  Edit an item when a claim has been approved by an
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $claim = DB::table('claims')
    ->where('id','=',$id)->first();
    $item_id = $claim->item_id;
    $user_id = $claim->user_id;
    DB::table('items')
    ->where('id',$item_id)
    ->update(['claimed_user_id' => $user_id]);
    DB::table('claims')->where('id','=',$id)->delete();
    return back()->with('success','The claim has been accepted');
  }

  /**
  * Update an items details but not the items images, this is done through
  * a seperate button (admin only)
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $item = Item::find($id);
    $this->validate(request(),[
      'category' => 'required',
      'color' => 'required',
      'date_found' => 'required|before:tomorrow'
    ]);
    $item->category = $request->input('category');
    $item->color = $request->input('color');
    $item->date_found = $request->input('date_found');
    $item->details = $request->input('details');
    $item->place = $request->input('place');
    $item->save();
    return back()->with('success', 'Item has been updated');

  }

  /**
  * Delete an item from the database (admin only)
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $item = Item::find($id);
    $item->delete();
    return back()->with('success', 'Item has been deleted');
  }
}
