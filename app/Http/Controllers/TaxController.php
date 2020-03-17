<?php

namespace App\Http\Controllers;

use App\Tax;
use App\Home;
use Session;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::paginate(10);
        $home = Home::first();
        return view('backend.admin.hotel_config.tax.index', compact('taxes','home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = Home::first();
        return view('backend.admin.hotel_config.tax.create', compact('home'));
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
            'name'=>'required|max:50|unique:taxes',
            'amount_1'=>'required|integer|min:1',
            'rate_1'=>'required|integer|min:1',
            'amount_2'=>'integer|min:1',
            'rate_2'=>'integer|min:1'
        ]);

        $tax = new Tax;
        $tax->name = $request->name;
        $tax->code = $request->code;
        $tax->amount_1 = $request->amount_1;
        $tax->amount_2 = $request->amount_2;
        $tax->rate_1 = $request->rate_1;
        $tax->rate_2 = $request->rate_2;
        $tax->status = $request->has('status')?1:0;
        $tax->save();

        Session::flash('message', "Added successfully");

        return redirect('/admin/hotel/tax');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        $home = Home::first();
        return view('backend.admin.hotel_config.tax.edit', compact('home','tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        $this->validate($request,[
            'name'=>'required|max:50',
            'amount_1'=>'required|integer|min:1',
            'rate_1'=>'required|integer|min:1',
            'amount_2'=>'integer|min:1',
            'rate_2'=>'integer|min:1'
        ]);

        $tax->name = $request->name;
        $tax->code = $request->code;
        $tax->amount_1 = $request->amount_1;
        $tax->amount_2 = $request->amount_2;
        $tax->rate_1 = $request->rate_1;
        $tax->rate_2 = $request->rate_2;
        $tax->status = $request->has('status')?1:0;
        $tax->save();

        Session::flash('message', "Updated successfully");

        return redirect('/admin/hotel/tax');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        Session::flash('message', "Deleted successfully");

        return redirect('/admin/hotel/tax');
    }
}
