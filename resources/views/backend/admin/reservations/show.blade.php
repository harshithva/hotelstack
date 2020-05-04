@extends('backend.admin.master')
@section('title', 'Reservation')
@section('main')
<div class="main-content p-4" id="panel">
    <div>
        <div class="card-header bg-white">
            <h2>Reservation
                <a class="btn btn-outline-success float-right" href="{{ route('reservations.index') }}"><i
                        class="fa fa-list"></i>&nbsp;Reservation List</a>
            </h2>
        </div>


        @if (Session::has('success'))

        <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>

        @endif

        @if (Session::has('danger'))

        <div class="alert alert-danger mt-2">{{ Session::get('danger') }}</div>

        @endif

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (Session::has('room'))

        <div class="alert alert-default mt-2">{{ Session::get('room') }}</div>

        @endif

        <div class="card-body bg-white">
            <ul class="nav nav-tabs d-print-none" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" href="#Details" role="tab" data-toggle="tab"
                        aria-selected="true">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Payments" role="tab" data-toggle="tab" aria-selected="false">Payments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Room" role="tab" data-toggle="tab" aria-selected="false">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Service" role="tab" data-toggle="tab" aria-selected="false">Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#print" role="tab" data-toggle="tab" aria-selected="false">Print View</a>
                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active show" id="Details">
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h2 class="page-header">
                                <img src="{{ asset('backend/assets/img/brand/blue.png') }}" class="img-fluid"
                                    style="max-height: 40px">
                                <br><br>
                                <small class="pull-right">Reservation Number: {{$reservation->uid}}</small>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-md-4 invoice-col">
                            Hotel Details <address> <br>
                                <strong>{{$hotel->name}}</strong><br>
                                Phone: {{$hotel->phone_number}}<br>
                                Email: {{$hotel->email}} <br>
                                Address: {{$hotel->address}} <br>
                                GSTTIN: {{$hotel->gst_number}} <br>
                            </address>
                        </div>
                        <div class="col-md-4 invoice-col">
                            Guest Details <address> <br>
                                <strong>{{$reservation->user->name}}</strong><br>
                                {{$reservation->user->address ?? ""}}
                                <br>
                                Phone: {{$reservation->user->phone}}<br>
                                Email: {{$reservation->user->email}}</address>
                        </div>
                        <div class="col-md-4 invoice-col">
                            <table width="90%">
                                <tbody>
                                    <tr>
                                        {{-- <th><b>Room Type</b></th>
                                        <th>:</th>
                                        <td>Deluxe Room</td> --}}
                                    </tr>
                                    <tr>
                                        <th><b>Booking Date:</b></th>
                                        <th>:</th>
                                        <td>{{$reservation->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Check in </b></th>
                                        <th>:</th>
                                        <td>{{$reservation->check_in}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Check out</b></th>
                                        <th>:</th>
                                        <td>{{$reservation->check_out}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Payment Status </b></th>
                                        <th>:</th>
                                        <td>
                                            <span class="badge badge-success">Paid</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>Booking Status </b></th>
                                        <th>:</th>
                                        @if ($reservation->status == 'PENDING')
                                        <td><span class="badge badge-info">Pending</span></td>
                                        @elseif($reservation->status == 'CANCEL')
                                        <td><span class="badge badge-danger">Cancelled</span></td>
                                        @else
                                        <td><span class="badge badge-success">Success</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th><b>Adults</b></th>
                                        <th>:</th>
                                        <td>{{$reservation->adults}} Person</td>
                                    </tr>
                                    <tr>
                                        <th><b>Kids </b></th>
                                        <th>:</th>
                                        <td>{{$reservation->kids}} Person</td>
                                    </tr>
                                    <tr>
                                        <th><b>Nights </b></th>
                                        <th>:</th>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <p class="lead text-info">Night list</p>
                            <table class=" table-sm w-100">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Room</th>
                                        <td align="right"><b>Price</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>2020-03-20</td>
                                        <td>
                                            105
                                        </td>
                                        <td align="right">1,299.00 Rupee</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td colspan="3"><b>Total Price</b></td>
                                        <td align="right"> <b> 1,299.00 Rupee</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table-sm w-100">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" align=""><b>Discount</b></td>
                                            <td class="text-right"><b>499.00 Rupee</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table-sm w-100">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" align=""><b>Payable Amount</b></td>
                                            <td class="text-right"><b>800.00 Rupee</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <p class="lead text-info">Payment</p>
                            <div class="table-responsive">
                                <table class="table-sm w-100">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Transaction</th>
                                            <th>Method</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2020-03-20 20:39:24</td>
                                            <td>1584716964-7583</td>
                                            <td>Cash</td>
                                            <td class="text-right"> 800 Rupee</td>
                                        </tr>
                                        <tr class="border-top">
                                            <td colspan="4" align=""><b>Total Payment</b></td>
                                            <td class="text-right"><b>800.00 Rupee</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align=""><b>Due</b></td>
                                            <td class="text-right"><b>0.00 Rupee</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="Payments">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mt-2  text-tsk">PAYMENT LIST</h4>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Transaction</th>
                                        <th>Method</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2020-03-20 20:39:24</td>
                                        <td>1584716964-7583</td>
                                        <td>Cash</td>
                                        <td class="text-right">₹ 800</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="Room">
                    <h4 class="mt-2 text-tsk">ROOM LIST</h4>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Room</th>
                                <th>Floor</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2020-03-20</td>
                                <td>105</td>
                                <td>
                                    1st Floor
                                </td>
                                <td class="text-right">
                                    <a href="#" class="btn btn-sm btn-tsk"
                                        onclick="confirm('Are you sure cancel this room?')?$('#room_delete_form_151').submit():false"><i
                                            class="fa fa-trash danger"></i></a>
                                    <a href="/manage_room/100/edit" class="btn btn-sm bg-secondary text-white"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    <form action="https://www.whitehouseinn.in/admin/reservation/151/cancel_room"
                                        method="post" id="room_delete_form_151"><input type="hidden" name="_token"
                                            value="bJCEMfZzztdhbATaIPQ2HvwmD317w80CBxragk4p"></form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="Service">
                    <h4 class="mt-2 text-tsk">SERVICE LIST</h4>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Service</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-danger">No service!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="print">
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h2 class="page-header">
                                <img src="https://www.whitehouseinn.in/assets/logo.png" style="max-height: 100px">
                                <small class="pull-right">Booking Number: #4445-1584716941</small>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-md-4 invoice-col">
                            Hotel Details <address>
                                <strong>White House Inn</strong><br>
                                Phone: 091485 08738,9148508737<br>
                                Email: contact@whitehouseinn.in <br>
                                veenu complex, Kundapura Main Rd, opp. canara bank, Kundapura, Karnataka 576201
                                GSTTIN:29AFRPP7885A1ZQ
                            </address>
                        </div>
                        <div class="col-md-4 invoice-col">
                            Guest Details <address>
                                <strong>Ambreesh R M</strong><br>
                                S/O MUTHAPPA,
                                #5,RAMAPURA,HGULIBALE
                                KOLAR,KARNATAKA
                                563114<br>
                                Phone: 9900272360<br>
                                Email: admin@gmail.com </address>
                        </div>
                        <div class="col-md-4 invoice-col">
                            <table width="90%">
                                <tbody>
                                    <tr>
                                        <th><b>Room Type</b></th>
                                        <th>:</th>
                                        <td>Deluxe Room</td>
                                    </tr>
                                    <tr>
                                        <th><b>Booking Date:</b></th>
                                        <th>:</th>
                                        <td>2020/03/20 20:39:01 PM</td>
                                    </tr>
                                    <tr>
                                        <th><b>Check in </b></th>
                                        <th>:</th>
                                        <td>2020-03-20</td>
                                    </tr>
                                    <tr>
                                        <th><b>Check out</b></th>
                                        <th>:</th>
                                        <td>2020-03-21</td>
                                    </tr>
                                    <tr>
                                        <th><b>Payment Status </b></th>
                                        <th>:</th>
                                        <td>
                                            <span class="badge badge-success">Paid</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>Booking Status </b></th>
                                        <th>:</th>
                                        <td><span class="badge badge-success">SUCCESS</span></td>
                                    </tr>
                                    <tr>
                                        <th><b>Adults</b></th>
                                        <th>:</th>
                                        <td>2 Person</td>
                                    </tr>
                                    <tr>
                                        <th><b>Kids </b></th>
                                        <th>:</th>
                                        <td>0 Person</td>
                                    </tr>
                                    <tr>
                                        <th><b>Nights </b></th>
                                        <th>:</th>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class=" table-sm w-100">
                                <tbody>
                                    <tr class="">
                                        <td><b>Night Fair</b></td>
                                        <td align="right"> <b> 1,299.00 Rupee</b></td>
                                    </tr>
                                    <tr class="">
                                        <td><b>Taxes</b></td>
                                        <td align="right"> <b> 0.00 Rupee</b></td>
                                    </tr>
                                    <tr class="">
                                        <td><b>Total Paid Service</b></td>
                                        <td align="right"> <b> 0.00 Rupee</b></td>
                                    </tr>
                                    <tr class="">
                                        <td><b>Discount</b></td>
                                        <td align="right"> <b> 499.00 Rupee</b></td>
                                    </tr>
                                    <tr class="border-top">
                                        <td><b>Payable Amount</b></td>
                                        <td align="right"> <b> 800.00 Rupee</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <p class="lead text-info">Payment</p>
                            <div class="table-responsive">
                                <table class="table-sm w-100">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Transaction</th>
                                            <th>Method</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2020-03-20 20:39:24</td>
                                            <td>1584716964-7583</td>
                                            <td>Cash</td>
                                            <td class="text-right"> 800 Rupee</td>
                                        </tr>
                                        <tr class="border-top">
                                            <td colspan="4" align=""><b>Total Payment</b></td>
                                            <td class="text-right"><b>800.00 Rupee</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class=" table-sm w-100">
                                <tbody>
                                    <tr class="">
                                        <td><b>Due</b></td>
                                        <td align="right"> <b> 0.00 Rupee</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @endsection

        @section('scripts')

        @endsection