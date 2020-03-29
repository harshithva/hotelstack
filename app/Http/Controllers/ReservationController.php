<?php

namespace App\Http\Controllers;
use App\User;

use App\Reservation;
use App\Home;
use App\RoomType;

use Session;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::orderBy('id', 'desc')->paginate(10);
        $home = Home::first();
        return view('backend.admin.reservations.index',compact('home','reservations'));
    }

    public function  selectGuest() {
        $guests = User::where('usertype','user')->orderBy('id', 'desc')->paginate(10);
        $home = Home::first();
        Session::flash('guest', "Select Guest");
        return view('backend.admin.reservations.select_guest', compact('home','guests'));
    }

    public function  selectRoomType(Request $request) {
    
        $guest = User::findOrFail($request->guest);
        $home = Home::first();
        $room_types = RoomType::all();
        Session::flash('type', "Select Room Type");
        return view('backend.admin.reservations.select_room_type', compact('home','guest','room_types'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
   
    }
    
        
        
            
               
            
            
}
