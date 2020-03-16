<?php

namespace App\Http\Controllers;


use App\RoomType;
use App\Home;
use Illuminate\Http\Request;
use Session;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_types = RoomType::all();
        $home = Home::first();
        return view('backend.admin.hotel_config.room_types.index', compact('room_types','home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = Home::first();
        return view('backend.admin.hotel_config.room_types.create', compact('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = str_slug($request->title);
        $this->validate($request,[
            'title'=>'required|max:191|unique:room_types',
            'slug'=>'required|max:191|unique:room_types',
            'short_code'=>'required|max:191|unique:room_types',
            'higher_capacity'=>'required|integer|min:1',
            'kids_capacity'=>'required|integer|min:0',
            'base_price'=>'required|numeric|min:0',
            'amenities'=>'nullable'
        ]);
        $roomType= new RoomType;
        $roomType->title = $request->title;
        $roomType->slug = $request->slug;
        $roomType->short_code = $request->short_code;
        $roomType->description = $request->description;
        $roomType->higher_capacity = $request->higher_capacity;
        $roomType->kids_capacity = $request->kids_capacity;
        $roomType->base_price = $request->base_price;
        $roomType->status = $request->has('status')?1:0;
        $roomType->save();
        if($request->has('amenities')){
            $roomType->amenity()->attach($request->amenities);
        }

        Session::flash('message', "Added successfully");

        return redirect('/admin/hotel/room_types');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        $home = Home::first();
        return view('backend.admin.hotel_config.room_types.edit', compact('home', 'roomType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $roomType)
    {
        $request['slug'] = str_slug($request->title);

        // $this->validate($request,[
        //     'title'=>'required|max:191|unique:room_types,title,',
        //     'slug'=>'required|max:191|unique:room_types,slug,',
        //     'short_code'=>'required|max:191|unique:room_types,short_code,',
        //     'higher_capacity'=>'required|integer|min:1',
        //     'kids_capacity'=>'required|integer|min:0',
        //     'base_price'=>'required|numeric|min:0',
        //     'amenities'=>'nullable'
        // ]);

        $roomType->title = $request->title;
        $roomType->slug = $request->slug;
        $roomType->short_code = $request->short_code;
        $roomType->description = $request->description;
        $roomType->higher_capacity = $request->higher_capacity;
        $roomType->kids_capacity = $request->kids_capacity;
        $roomType->base_price = $request->base_price;
        $roomType->status = $request->has('status')?1:0;
        $roomType->save();

        Session::flash('message', "Updation successful");

        return redirect('/admin/hotel/room_types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $roomType)
    {
        $roomType->delete();

        Session::flash('message', "Deleted successfully");

        return redirect('/admin/hotel/room_types');
    }
}
