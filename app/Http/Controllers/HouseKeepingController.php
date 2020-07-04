<?php

namespace App\Http\Controllers;

use App\HouseKeeping;
use App\Room;
use Session;
use Illuminate\Http\Request;

class HouseKeepingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $housekeepings = HouseKeeping::all();
    
        return view('backend.admin.housekeeping.index',compact('housekeepings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();
        return view('backend.admin.housekeeping.create',compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store the housekeeping
       $housekeeping = new HouseKeeping;
       $housekeeping->room_id = $request->room_id;
       $housekeeping->cleaned_by = $request->cleaned_by;
       $housekeeping->status = $request->status;
       $housekeeping->save();

    //    go back
       return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HouseKeeping  $houseKeeping
     * @return \Illuminate\Http\Response
     */
    public function show(HouseKeeping $houseKeeping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HouseKeeping  $houseKeeping
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseKeeping $houseKeeping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HouseKeeping  $houseKeeping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseKeeping $houseKeeping)
    {
        $houseKeeping->status = $request->status;
        $houseKeeping->save();
        rediret()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HouseKeeping  $houseKeeping
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseKeeping $houseKeeping)
    {
        $houseKeeping->delete();
        Session::flash('housekeeping_deleted', "Deleted");
        return redirect()->back();
    }
}
