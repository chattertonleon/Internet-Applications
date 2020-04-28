<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claims;
use App\Item;
use \DB;

class ClaimsController extends Controller
{
    /**
     * Display a listing of all claims
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = DB::table('claims')
                            ->join('items','claims.item_id','=','items.id')
                            ->select('claims.user_id','claims.item_id','claims.id','items.category',
                            'items.color','items.date_lost','claims.reason')
                            ->get();
        return view('admin.index',compact('claims'));
    }

    /**
     * Show the form for creating a claim
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('claims.create');
    }

    /**
     * Store a claim in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $item = $this->validate(request(), [
        'reason' => 'required'
      ]);

      $claim = new Claims;
      $claim->item_id = session("itemID");
      $claim->user_id = auth()->user()->id;
      $claim->reason = $request->input('reason');
      $claim->save();
      return redirect('items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Prepare a session for the item who's claim is to be accepted or deleted
     * Show the appropriate view for which this is to occur on
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session_start();
        session(['itemID' => $id]);
        return view('claims/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove a claim from the database claim table
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $claim = DB::table('claims')->where('id','=',$id)->first();
      $item_id = $claim->item_id;
      DB::table('items')
         ->where('id',$item_id)
         ->update(['claimed_user_id' => null]);
      Claims::where('id','=',$id)->delete();
      return back()->with('success','The claim has been rejected');
    }
}
