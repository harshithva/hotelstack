<?php

namespace App\Http\Controllers;
use App\User;
use App\Home;
use App\Room;
use Carbon\Carbon;
use Session;

use App\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        $home= Home::first();

        if(auth()->user()->usertype == 'admin')
        {
            $reservations = Reservation::orderBy('id', 'desc')->paginate(10);
            $checkins = Reservation::where('checked_in',1)->orderBy('id', 'desc')->paginate(10);
            
            $home = Home::first();
            $date = Carbon::now();
            $year = $date->year;
        $month = $date->month;
            if ($month < 10) {
                $month = '0' . $month;
            }
     
            $thisMonth = $year . '-' . $month;

            $monthlyReservationCount = Reservation::where('created_at', 'like', $thisMonth .'%')->count();
            $monthlyCheckInCount = Reservation::where('checked_in',1)->where('created_at', 'like', $thisMonth .'%')->count();
            $roomsCount = Room::get()->count();
            $guestCount = User::get()->count();
            
            return view('backend.admin.dashboard', compact('home','reservations','monthlyReservationCount','monthlyCheckInCount','checkins','roomsCount','guestCount'));
        }
        else 
        {
            return view('backend.user.dashboard', compact('home'));
        }
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    

}
