<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Item;

class ImagesController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

  }

  /**
  * Show all the images for a particular item entry
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $images = Image::where('image_item_id',$id)->get();
    return view('images.show',compact('images'));
  }

  /**
  *  Get all the images for a particular ite entry and prepare them for editing
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $images = Image::where('image_item_id','=',$id)->get();
    return view('images.edit',compact('images','id'));
  }

  /**
  *  Update an items images dependent on the input from the image page
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $this->validate(request(),[
      'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000'
    ],[
      'images.*.required' => 'An image is required to be uploaded to the server',
      'images.*.image' => 'All files uploaded must be an image',
      'images.*.mimes' => 'All images uploaded must be of type jpeg,png,jpg,gif or svg',
      'images.*.max' => 'All images uploaded must be less than 2MB each'
    ]);

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
        $newImage->image_item_id = $id;
        $newImage->save();
      }
    }
    return back();
  }

  /**
  * Remove an image belonging to an item
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $image = Image::find($id);
    $image->delete();
    return back()->with('success','The image has been deleted');
  }
}
