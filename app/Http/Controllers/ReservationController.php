<?php

namespace App\Http\Controllers;
use App\User;

use App\Reservation;
use App\Home;
use App\Tax;
use App\RoomType;
use App\Room;

use Session;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $reservation;

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

    public function  selectRoomDetails(Request $request) {
    
        $guest = User::findOrFail($request->guest);
        $home = Home::first();
        $room_types = RoomType::all();
        Session::flash('details', "Please Enter the details");
        return view('backend.admin.reservations.select_room_details', compact('home','guest','room_types'));
    }

    public function getRooms(Request $request) {
      
        // $rooms = RoomType::rooms()->get();
        $roomTypes = RoomType::all();
        $home = Home::first();
        
        $guest = User::findOrFail($request->user_id);
        $room_types = RoomType::all();
        // $selected_type = RoomType::findOrFail($request->room_type_id);
        $guest->adults = $request->adults;
        $guest->kids = $request->kids;
        $guest->check_in = $request->check_in;
        $guest->check_out = $request->check_out;
        $taxes = Tax::all();
        Session::flash('room', "Select room");
        return view('backend.admin.reservations.select_room',compact('home','guest','room_types','taxes','roomTypes'));
    }

    public function calculateSum(Request $request) {
        // dd($request);
        $home = Home::first();
        $rooms = explode(',',$request->rooms);
        $reservation = new Reservation;
        $reservation->rooms = $rooms;
        $reservation->guest = $request->user_id;
        $reservation->roomsCount = count($rooms);
        $reservation->adults = $request->adults;
        $reservation->kids = $request->kids;
        $reservation->nights = $request->nights;
        $reservation->check_in = $request->check_in;
        $reservation->check_out = $request->check_out;
        $reservation->total = array_sum($request->roomtype_total);
        $roomType_tax=[];
        $room_numbers=[];

        for ($i=0; $i < count($request->roomtype_total); $i++) { 
            $tax = Tax::find($request->taxes[$i]);
            $roomType_total = $request->roomtype_total[$i];
            $tax = $this->calculateTax($tax, $roomType_total);
            array_push( $roomType_tax, $tax);
        }
        $reservation->total_tax = array_sum($roomType_tax);

        foreach ($reservation->rooms as $room_id) {
            $room = Room::find($room_id);
            array_push( $room_numbers, $room);
          }

        $reservation->rooms = $room_numbers;

        $reservation->rooms_count = count($room_numbers);
        $reservation->total_plus_tax =  $reservation->total+ $reservation->total_tax;
        $this->reservation = $reservation;
     
        Session::flash('confrim', "Please Confrim details");
        return view('backend.admin.reservations.confrim',compact('home',"reservation"));
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
        dd($request);
        // dd($this->reservation);
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
    
        
   function calculateTax($tax, $net_price) {

        if($tax) {
        if($net_price >= $tax->amount_1){
          return (float) (($net_price/100) * $tax->rate_1);
        }else if($net_price >= $tax->amount_2){
         return (float) (($net_price/100) * $tax->rate_2);
        }
        else
        {  
          return 0;
        }
        }
       
      }
            
}
