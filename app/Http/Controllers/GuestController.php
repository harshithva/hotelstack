<?php

namespace App\Http\Controllers;
use App\Home;
use App\User;
use Carbon\Carbon;
use Session;

use Illuminate\Http\Request;

class GuestController extends Controller
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
        $guests = User::where('usertype','user')->paginate(10);
        $home = Home::first();
        return view('backend.admin.guests.index', compact('home','guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = Home::first();
        return view('backend.admin.guests.create', compact('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$this->validate($request,[
        'name'=>'required|max:50',
        'last_name'=>'min:1',
        'phone'=>'min:4',
        'email'=>'required|email|unique:users|max:50'
    ]);

  

    $guest = new User;
    $guest->name = $request->name;
    $guest->last_name = $request->last_name;
    $guest->phone = $request->phone;
    $guest->email = $request->email;
    $guest->password = bcrypt($request->password);
    $guest->dob =  Carbon::createFromFormat('d/m/Y', $request->dob);
    $guest->address = $request->address;
    $guest->sex = $request->sex;
    $guest->id_type = $request->id_type;
    $guest->id_number = $request->id_number;
    $guest->id_card_image = $request->id_card_image;
    $guest->remarks = $request->remarks;
    $guest->vip = $request->has('vip')?1:0;
    $guest->status = $request->has('status')?1:0;
    $guest->save();

    Session::flash('message', "Added successfully");

    return redirect('/admin/hotel/guests');
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
        $user = User::findOrFail($id);
        $user->delete();

        Session::flash('message', "Guest deleted successfully");

    return redirect('/admin/hotel/guests');
    }
}
