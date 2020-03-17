<?php

namespace App\Http\Controllers;
use App\Home;
use Session;

use App\PaidService;
use Illuminate\Http\Request;

class PaidServiceController extends Controller
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
        $paid_services = PaidService::paginate(10);
        $home = Home::first();
        return view('backend.admin.hotel_config.paid_services.index', compact('paid_services','home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = Home::first();
        return view('backend.admin.hotel_config.paid_services.create', compact('home'));
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
            'title'=>'required|max:50|unique:paid_services',
            'price'=>'required|integer|unique:paid_services',
            'description'=>'max:191',
        ]);
        $paid_service = new PaidService;
        $paid_service->title = $request->title;
        $paid_service->price = $request->price;
        $paid_service->short_desc = $request->short_desc;
        $paid_service->status = $request->has('status')?1:0;
        $paid_service->save();

        Session::flash('message', "Added successfully");

        return redirect('/admin/hotel/paid_services');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaidService  $paidService
     * @return \Illuminate\Http\Response
     */
    public function show(PaidService $paidService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaidService  $paidService
     * @return \Illuminate\Http\Response
     */
    public function edit(PaidService $paidService)
    {
        $home = Home::first();
        return view('backend.admin.hotel_config.paid_services.edit', compact('home', 'paidService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaidService  $paidService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaidService $paidService)
    {
        $this->validate($request,[
            'title'=>'required|max:50',
            'price'=>'required|integer',
            'description'=>'max:191',
        ]);
        
        $paidService->title = $request->title;
        $paidService->price = $request->price;
        $paidService->short_desc = $request->short_desc;
        $paidService->status = $request->has('status')?1:0;
        $paidService->save();

        Session::flash('message', "Updated successfully");

        return redirect('/admin/hotel/paid_services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaidService  $paidService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaidService $paidService)
    {
        $paidService->delete();
        
        Session::flash('message', "Deleted successfully");

        return redirect('/admin/hotel/paid_services');
    }
}
