<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Reservation;
use App\HotelDetail;
use App\PaidService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       // delete invoice if exits
       Invoice::where('checkin_id',$request->checkin_id)->delete();
        $invoice = new Invoice;
        $invoice->checkin_id = $request->checkin_id;
        $invoice->tax = $request->tax;
        $invoice->save();
        $reservation = Reservation::findOrFail($request->checkin_id);
        $payment_list = $reservation->payment;
        $reservation->total_paid = 0;
        foreach ($payment_list as $payment) {
          $reservation->total_paid += $payment->amount;
        }
        $extra = 0;
        foreach ($reservation->service as $service) {
          $extra += $service->paid_service->price*$service->quantity;
        }

         $reservation->total_tax = (($reservation->total + $extra)*$reservation->invoice->tax)/100;
         $hotel = HotelDetail::first();
        $paid_services = PaidService::all();
      return view('backend.admin.check_in.invoice',compact('reservation','hotel','extra'));
     }

 
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
      
        $payment_list = $reservation->payment;
        $reservation->total_paid = 0;
        foreach ($payment_list as $payment) {
          $reservation->total_paid += $payment->amount;
        }
        $extra = 0;
        foreach ($reservation->service as $service) {
          $extra += $service->paid_service->price*$service->quantity;
        }

         $reservation->total_tax = (($reservation->total + $extra)*$reservation->invoice->tax)/100;
         $hotel = HotelDetail::first();
        $paid_services = PaidService::all();
      return view('backend.admin.check_in.invoice',compact('reservation','hotel','extra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
  
  
        $invoice->checkin_id = $request->checkin_id;
        $invoice->tax = $request->tax;
        $invoice->save();
        $reservation = Reservation::findOrFail($request->checkin_id);
        $payment_list = $reservation->payment;
        $reservation->total_paid = 0;
        foreach ($payment_list as $payment) {
          $reservation->total_paid += $payment->amount;
        }
        $extra = 0;
        foreach ($reservation->service as $service) {
          $extra += $service->paid_service->price*$service->quantity;
        }

         $reservation->total_tax = (($reservation->total + $extra)*$reservation->invoice->tax)/100;
         $hotel = HotelDetail::first();
        $paid_services = PaidService::all();
      return view('backend.admin.check_in.invoice',compact('reservation','hotel','extra'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
