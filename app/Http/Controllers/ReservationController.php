<?php

namespace App\Http\Controllers;
use App;
use App\User;
use App\Mail\ReservationMail;

use App\Reservation;
use App\Home;
use App\Tax;
use App\RoomType;
use App\Room;
use App\ReservationRoom;
use App\HotelDetail;

use Carbon\Carbon;

use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
 
       $dateCheckin = Carbon::createFromFormat('d/m/Y', $request->check_in)->format('Y-m-d');
      $dateCheckout = Carbon::createFromFormat('d/m/Y', $request->check_out)->format('Y-m-d');

      $reservations = Reservation::where('active', 1)
      ->where(function($query) use ($dateCheckin, $dateCheckout){
                  $query->where([
                      ['check_in', '<=', $dateCheckin],
                      ['check_out', '>=', $dateCheckin]
                  ])
                  ->orWhere([
                      ['check_in', '<', $dateCheckout],
                      ['check_out', '>=', $dateCheckout]
                  ])
                  ->orWhere([
                      ['check_in', '>=', $dateCheckin],
                      ['check_out', '<', $dateCheckout]
                  ]);
              })
            ->orderBy('check_in')
            ->get();
           
            $bookedRooms = [];
            foreach($reservations as $reservation)
            {
              $bookedRooms = ReservationRoom::where('reservation_id', $reservation->id)->get();
            }

            if(empty($bookedRooms)){
              $roomTypes = RoomType::with('rooms')->get();
            }else {
              $availableRooms = [];
              foreach($bookedRooms as $bookedRoom)
              {
                $reservedRoom = $bookedRoom->pluck('room_id')->toArray();
               
                // Room::where('room_type_id',$room_type)->whereNotIn('id', $reservedRooms)->get();
                $availableRooms = Room::whereNotIn('id', $reservedRoom)->pluck('id')->toArray();
               
              }
       
            // dd($availableRooms);
            
                $roomTypes = RoomType::with(['rooms'=> function($query) use ($availableRooms) {
                  $query->whereIn('id', $availableRooms);
                }
                ])->get();
            }
           
            
            
// dd($roomTypes);
            
            
      //       foreach($roomTypes as $roomType)
      //       {
      //         foreach($availableRooms as $availableRoom)
      //         {
      //           $roomType->rooms->filter(function ($value, $key) {
      //             return $value->id == $availableRoom;
      //         });
      //         }
      //       }
           
      // dd($roomTypes);
        // $rooms = RoomType::rooms()->get();
        
        $home = Home::first();
        
        $guest = User::findOrFail($request->user_id);
        $room_types = RoomType::all();
        $reservations = Reservation::all();
      
        // dd($room_types->rooms());
        // $reservations = Reservation::all();
        // foreach ($reservations as $key => $r) {
        //    dd($r->reservation_rooms()->room);
        // }
      
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
      // dd("hi");
    //   $this->validate($request,[
    //     'rooms_count'=>'required'
    // ]);


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
        $data = json_decode($request->reservation);

        // $this->validate($request,[
        //     'guest'=>'required|integer',
        //     'adults'=>'required|integer|min:1',
        //     'kids'=>'required|integer|min:0',
        //     'check_in'=>'required|date|after_or_equal:today',
        //     'check_out'=>'required|date|after_or_equal:check_in',
        //     'night_list'=>'required',
        //     'rooms_count'=>'required'
        // ]);

        $reservation = new Reservation;
        $reservation->uid = sprintf("%06d", mt_rand(1, 999999));
        $reservation->user_id = $data->guest;
        $reservation->adults = $data->adults;
        $reservation->kids = $data->kids;
        $reservation->check_in = Carbon::createFromFormat('d/m/Y', $data->check_in);
        $reservation->check_out = Carbon::createFromFormat('d/m/Y',$data->check_out);
        $reservation->number_of_room = $data->rooms_count;
        $reservation->total = $data->total;
        $reservation->total_tax = $data->total_tax;
        $reservation->total_plus_tax = $data->total_plus_tax;

        $reservation_id = $reservation->uid;
        $reservation->save();

        try {

            foreach($data->rooms as $room)
            {
                $reservation_room = new ReservationRoom;
                $reservation_room->reservation_id = $reservation->id;
                $reservation_room->room_id = $room->id;
        
                $reservation_room->check_in = Carbon::createFromFormat('d/m/Y', $data->check_in);
                $reservation_room->check_out = Carbon::createFromFormat('d/m/Y', $data->check_out);
                $reservation_room->save();
            }
          }
          
          //catch exception
          catch(Exception $e) {
             Session::flash('danger', "Oops..Something went wrong!");
            return redirect()->route('reservations.index');
          }
          $guest = User::find($reservation->user_id);
          $name = $guest->name;
          $phone = $guest->phone;
        

          $reservation->status = 'SUCCESS';
          $reservation->save();

          
          // $sender = 'VAWEBS';
         
          // $message = "Hi $name, This message is to inform that you have made a successful reservation. ReservationID: $reservation_id, Check in : $reservation->check_in, Check out: $reservation->check_out, Total: $reservation->total_plus_tax";

          // $authentication_key = config('app.auth_key');
         
        

          // $curl = curl_init();
          
          // curl_setopt_array($curl, array(
          //   CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
          //   CURLOPT_RETURNTRANSFER => true,
          //   CURLOPT_ENCODING => "",
          //   CURLOPT_MAXREDIRS => 10,
          //   CURLOPT_TIMEOUT => 30,
          //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          //   CURLOPT_CUSTOMREQUEST => "POST",
          //   CURLOPT_POSTFIELDS => "{ \"sender\": \"$sender\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"$message\", \"to\": [ \"$phone\"] } ] }",
          //   CURLOPT_SSL_VERIFYHOST => 0,
          //   CURLOPT_SSL_VERIFYPEER => 0,
          //   CURLOPT_HTTPHEADER => array(
          //     "authkey: $authentication_key",
          //     "content-type: application/json"
          //   ),
          // ));
          
          // $response = curl_exec($curl);
          // $err = curl_error($curl);
          
          // curl_close($curl);
          
          // if ($err) {
          //   echo "cURL Error #:" . $err;
          // } else {
          //   echo $response;
          // }

        //   Send Mail
        $data = [
            'name' => $guest->name,
            'total' => $reservation->total_plus_tax,
            'check_in' => $data->check_in,
            'check_out' => $data->check_out,
            'total_tax' => $reservation->total_tax,
     ];
    
        Mail::to($guest->email)->send(new ReservationMail($data));


        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
      $home = Home::first();
      $hotel = HotelDetail::first();
      // $r = $reservation->reservation_room;
      // dd($r);
      return view("backend.admin.reservations.show",compact("home", "reservation","hotel"));
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
      $reservation->status = "CANCEL";
      $reservation->active = 0;
      $reservation->save();
      return redirect()->route('reservations.index');
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
