<?php

namespace App\Http\Controllers;

use App\Room;
use App\Home;
use App\Floor;
use App\RoomType;
use Session;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        $home = Home::first();
        return view('backend.admin.hotel_config.rooms.index', compact('rooms','home'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = Home::first();
        $floors = Floor::all();
        $room_types = RoomType::all();
        return view('backend.admin.hotel_config.rooms.create', compact('home','floors','room_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'number'=>'required|integer|unique:rooms|min:1',
            'room_type_id'=>'required|integer',
            'floor_id'=>'required|integer',
            'status'=>'required',
            'image' => 'nullable'
        ]);

           // Handle File Upload
   if($request->hasFile('image')){
    // Get filename with the extension
    $filenameWithExt = $request->file('image')->getClientOriginalName();
    // Get just filename
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    // Get just ext
    $extension = $request->file('image')->getClientOriginalExtension();
    // Filename to store
    $fileNameToStore= $filename.'_'.time().'.'.$extension;
    // Upload Image
    $path = $request->file('image')->storeAs('public/rooms', $fileNameToStore);
} 

        $room = new Room;
        $room->number = $request->number;
        $room->room_type_id = $request->room_type_id;
        $room->floor_id = $request->floor_id;
        if(!empty($fileNameToStore)){
            $room->image = $fileNameToStore;
        }
         
        $room->status = $request->has('status')?1:0;
        $room->save();

        Session::flash('message', "Added successfully");

        return redirect('/admin/hotel/rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        
        $home = Home::first();
        $floors = Floor::all();
        $room_types = RoomType::all();
        return view('backend.admin.hotel_config.rooms.edit', compact('home','floors','room_types','room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {  
        $this->validate($request,[
        'number'=>'required|integer|min:1',
        'room_type_id'=>'required|integer',
        'floor_id'=>'required|integer',
        'status'=>'required',
        'image' => 'nullable'
    ]);

        // Handle File Upload
    if($request->hasFile('image')){
    // Get filename with the extension
    $filenameWithExt = $request->file('image')->getClientOriginalName();
    // Get just filename
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    // Get just ext
    $extension = $request->file('image')->getClientOriginalExtension();
    // Filename to store
    $fileNameToStore= $filename.'_'.time().'.'.$extension;
    // Upload Image
    $path = $request->file('image')->storeAs('public/rooms', $fileNameToStore);

    $room->image = $fileNameToStore;
    } 

    $room->number = $request->number;
    $room->room_type_id = $request->room_type_id;
    $room->floor_id = $request->floor_id;
    $room->status = $request->has('status')?1:0;
    $room->save();

    Session::flash('message', "Updated successfully");

    return redirect('/admin/hotel/rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        Session::flash('message', "Deleted successfully");

    return redirect('/admin/hotel/rooms');
    }
}
