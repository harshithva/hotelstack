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
use App\PaidService;
use App\ReservationRoom;
use Carbon\Carbon;
use App\HotelDetail;

use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class CheckInController extends Controller
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
        
        $reservations = Reservation::where('checked_in', 1)->orderBy('id', 'desc')->get();
        $home = Home::first();
        return view('backend.admin.check_in.index',compact('home','reservations'));
    }

    public function  selectGuest() {
        $guests = User::where('usertype','user')->orderBy('id', 'desc')->paginate(10);
        $home = Home::first();
        Session::flash('guest', "Select Guest");
        return view('backend.admin.check_in.select_guest', compact('home','guests'));
    }

    public function  selectRoomDetails(Request $request) {
    
        $guest = User::findOrFail($request->guest);
        $home = Home::first();
        $room_types = RoomType::all();
        Session::flash('details', "Please Enter the details");
        return view('backend.admin.check_in.select_room_details', compact('home','guest','room_types'));
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
         
         $home = Home::first();
         
         $guest = User::findOrFail($request->user_id);
         $room_types = RoomType::all();
         $reservations = Reservation::all();
       
    
         $guest->adults = $request->adults;
         $guest->kids = $request->kids;
         $guest->check_in = $request->check_in;
         $guest->check_out = $request->check_out;
         $taxes = Tax::all();
         Session::flash('room', "Select room");
         return view('backend.admin.check_in.select_room',compact('home','guest','room_types','taxes','roomTypes'));
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
        
     
        Session::flash('confrim', "Please Confrim details");
        return view('backend.admin.check_in.confrim',compact('home',"reservation"));
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
        
        $data = json_decode($request->reservation);
        

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
        $reservation->checked_in = 1;

        $reservation_id = $reservation->uid;
        $reservation->status = 'SUCCESS';
        $reservation->save();

        try {

            foreach($data->rooms as $room)
            {
                $reservation_room = new ReservationRoom;
                $reservation_room->reservation_id = $reservation->id;
                $reservation_room->room_id = $room->id;
        
                $reservation_room->save();
            }
          }
          
          //catch exception
          catch(Exception $e) {
             Session::flash('danger', "Oops..Something went wrong!");
            return redirect()->route('reservations.index');
          }
    //       $guest = User::find($reservation->user_id);
    //       $name = $guest->name;
    //       $phone = $guest->phone;
        

    //       $reservation->status = 'SUCCESS';
    //       $reservation->save();

          
    //       $sender = 'VAWEBS';
         
    //       $message = "Hi $name, This message is to inform that you have made a successful reservation. ReservationID: $reservation_id, Check in : $reservation->check_in, Check out: $reservation->check_out, Total: $reservation->total_plus_tax";

    //       $authentication_key = config('app.auth_key');
         
        

    //       $curl = curl_init();
          
    //       curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => "{ \"sender\": \"$sender\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"$message\", \"to\": [ \"$phone\"] } ] }",
    //         CURLOPT_SSL_VERIFYHOST => 0,
    //         CURLOPT_SSL_VERIFYPEER => 0,
    //         CURLOPT_HTTPHEADER => array(
    //           "authkey: $authentication_key",
    //           "content-type: application/json"
    //         ),
    //       ));
          
    //       $response = curl_exec($curl);
    //       $err = curl_error($curl);
          
    //       curl_close($curl);
          
    //       if ($err) {
    //         echo "cURL Error #:" . $err;
    //       } else {
    //         echo $response;
    //       }

    //     //   Send Mail
    //     $data = [
    //         'name' => $guest->name,
    //         'total' => $reservation->total_plus_tax,
    //         'check_in' => $data->check_in,
    //         'check_out' => $data->check_out,
    //         'total_tax' => $reservation->total_tax,
    //  ];
    
    //     Mail::to($guest->email)->send(new ReservationMail($data));


        return redirect()->route('checkin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $home = Home::first();
      $hotel = HotelDetail::first();
      $reservation = Reservation::findOrFail($id);
      $paid_services = PaidService::all();
    
      $payment_list = $reservation->payment;
      $reservation->total_paid = 0;
      foreach ($payment_list as $payment) {
        $reservation->total_paid += $payment->amount;
      }
      $extra = 0;
      // dd($reservation->service);
      foreach ($reservation->service as $service) {

        $extra += $service->paid_service->price*$service->quantity;
      }

     
      $dateCheckin = $reservation->check_in;
      $dateCheckout = $reservation->check_out;

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
                $rooms = Room::whereIn('id', $availableRooms)->get();
          
          
            }
     
     
     
      return view("backend.admin.check_in.show",compact("home", "reservation","hotel","paid_services","extra","rooms"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $reservation = Reservation::findOrFail($id);
      $guests = User::all();


      $dateCheckin = $reservation->check_in;
      $dateCheckout = $reservation->check_out;
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
                $rooms = Room::whereIn('id', $availableRooms)->get();
          
          
            }
      return view("backend.admin.check_in.edit",compact("reservation","guests","rooms"));
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
        // dd($request);

        $checkin = Reservation::findOrFail($id);
        $checkin->user_id = $request->user_id;
        $checkin->adults = $request->adults;
        $checkin->kids = $request->kids;
        $checkin->check_in = Carbon::createFromFormat('d/m/Y', $request->check_in);
        $checkin->check_out = Carbon::createFromFormat('d/m/Y', $request->check_out);
        $checkin->checked_in = $request->checked_in;
        $checkin->checked_out = $request->checked_out;
        $checkin->total = $request->total;
        // $checkin->total_tax = $request->total_tax;
        // $checkin->total_plus_tax = $request->total_plus_tax;
        $checkin->save();

        Session::flash('checkin_update', "Updated");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $reservation = Reservation::findOrFail($id);
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


    public function check_out($id)
    {
      $reservation = Reservation::findOrFail($id);
      $reservation->checked_out = 1;
      $reservation->save();
      return redirect()->back();
    }
}
