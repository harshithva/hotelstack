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
        $guests = User::where('usertype','user')->orderBy('id', 'desc')->paginate(10);
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
    {
        $this->validate($request,[
        'name'=>'required|max:50',
        'last_name'=>'max:50',
        'email'=>'unique:users|max:50'
    ]);

    $guest = new User;

    // Handle File Upload
   if($request->hasFile('id_card_image_front')){
    // Get filename with the extension
    $filenameWithExt = $request->file('id_card_image_front')->getClientOriginalName();
    // Get just filename
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    // Get just ext
    $extension = $request->file('id_card_image_front')->getClientOriginalExtension();
    // Filename to store
    $fileNameToStore= $filename.'_'.time().'.'.$extension;
    // Upload Image
    $path = $request->file('id_card_image_front')->storeAs('public/users', $fileNameToStore);

    $guest->id_card_image_front = $fileNameToStore;

} 

    // Handle File Upload
    if($request->hasFile('id_card_image_back')){
        // Get filename with the extension
        $filenameWithExt = $request->file('id_card_image_back')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('id_card_image_back')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('id_card_image_back')->storeAs('public/users', $fileNameToStore);
    
        $guest->id_card_image_back = $fileNameToStore;
    
    } 

    $guest->name = $request->name;
    $guest->last_name = $request->last_name;
    $guest->company_name = $request->company_name;
    $guest->gst_no = $request->gst_no;
    $guest->phone = $request->phone;

    if($request->email !== null)
    {
        $guest->email = $request->email;
    }
    else
    {
    $guest->email = 'customer'.time().'@gmail.com';
    }

    if($request->password !== null)
    {
        $guest->password = bcrypt($request->password);
    }
    else
    {
      $randomPassword = md5(rand());
     $guest->password = $randomPassword;
    }


    if($request->dob !== null)
    {
        $guest->dob =  Carbon::createFromFormat('d/m/Y', $request->dob);
    }
    $guest->address = $request->address;
    $guest->sex = $request->sex;
    $guest->id_type = $request->id_type;
    $guest->id_number = $request->id_number;
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
        $guest = User::findOrFail($id);
        $home = Home::first();

        if($guest->dob !== null)
        {
        $guest->dob = Carbon::createFromFormat('Y-m-d', $guest->dob)->format('d/m/Y');
        }

        return view('backend.admin.guests.edit', compact('home','guest'));
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

        $this->validate($request,[
            'name'=>'required|max:50',
            'last_name'=>'min:1',
            'email'=>'required|email|max:50'
        ]);
    
        $guest = User::findOrFail($id); 
        $guest->name = $request->name;
        $guest->last_name = $request->last_name;
        $guest->phone = $request->phone;
        $guest->email = $request->email;
        $guest->company_name = $request->company_name;
        $guest->gst_no = $request->gst_no;
        
        if($request->has('password'))
        {
            $guest->password = bcrypt($request->password);
        }

        if($request->dob !== null)
        {
        $guest->dob =  Carbon::createFromFormat('d/m/Y', $request->dob);
        }

        $guest->address = $request->address;
        $guest->sex = $request->sex;
        $guest->id_type = $request->id_type;
        $guest->id_number = $request->id_number;
        
                // Handle File Upload
        if($request->hasFile('id_card_image_front')){
            // Get filename with the extension
            $filenameWithExt = $request->file('id_card_image_front')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('id_card_image_front')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('id_card_image_front')->storeAs('public/users', $fileNameToStore);

            $guest->id_card_image_front = $fileNameToStore;

        } 

          // Handle File Upload
    if($request->hasFile('id_card_image_back')){
        // Get filename with the extension
        $filenameWithExt = $request->file('id_card_image_back')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('id_card_image_back')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('id_card_image_back')->storeAs('public/users', $fileNameToStore);
    
        $guest->id_card_image_back = $fileNameToStore;
    
    } 

        $guest->remarks = $request->remarks;
        $guest->vip = $request->has('vip')?1:0;
        $guest->status = $request->has('status')?1:0;
        $guest->save();
    
        Session::flash('message', "Updated successfully");
    
        return redirect('/admin/hotel/guests');
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

    public function searchGuest(Request $request)
    {
        $home = Home::first();
        $q = $request->q;
        if($q !== null){

            $guests = User::where ( 'name', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'email', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'phone', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'id_number', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'id', 'LIKE', '%' . $q . '%' )
            ->paginate(10);

            if (count ( $guests ) > 0)
            {
                return view( 'backend.admin.guests.index', compact('home','guests','q'));
            }
                
            else
            {
                Session::flash('danger', "No Records Found");

                return redirect('/admin/hotel/guests');
            }
           
        }
    }
}
