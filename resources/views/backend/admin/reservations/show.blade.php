@extends('backend.admin.master')
@section('title', 'Reservation')
@section('main')
<div class="main-content p-4" id="panel">
    <div>
        <div class="card-header bg-white d-print-none">
            <h2>Reservation
                <a class="btn btn-outline-success float-right" href="{{ route('reservations.index') }}"><i
                        class="fa fa-list"></i>&nbsp;Reservation List</a>
            </h2>
            <div class="mt-3">

                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_payment">
                    Add Payment
                </button>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_service">
                    Add Service
                </button>
                <button class="btn btn-outline-default btn-sm" onclick="javascript:window.print()"><i
                        class="fa fa-print"></i></button>
                <form action="{{route("reservations.checkin",$reservation->id)}}" method="post" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning btn-sm">Check in</button>
                </form>
                <form action="{{route("reservations.mark_noshow",$reservation->id)}}" method="post"
                    class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-outline-default btn-sm">Mark noshow</button>
                </form>
            </div>


            <div class="modal fade d-print-none" id="add_payment" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{route('payment.store')}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12" data-children-count="1">
                                        <label><strong data-children-count="0">Reservation Number</strong></label>
                                        <input class="form-control" readonly="" value="{{$reservation->uid}}">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12" data-children-count="1">
                                        <label><strong data-children-count="0">Date</strong></label>
                                        <input class="form-control" name="date" readonly="" value="{{date('d/m/Y')}}">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12" data-children-count="1">
                                        <label><strong data-children-count="0">Payment
                                                Method</strong></label>
                                        <select class="form-control" name="method">
                                            <option value="CASH" selected>Cash</option>
                                            <option value="CARD">Card</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="reservation_id" value="{{$reservation->id}}" type="number">
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12" data-children-count="1">
                                        <label><strong data-children-count="0">Amount</strong></label>
                                        <input class="form-control" name="amount" value="" placeholder="0.00" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Pay</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Add service --}}

        <div class="modal fade d-print-none" id="add_service" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="{{route('service.store')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12" data-children-count="1">
                                    <label><strong data-children-count="0">Reservation Number</strong></label>
                                    <input class="form-control" readonly="" value="{{$reservation->uid}}">
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12" data-children-count="1">
                                    <label><strong data-children-count="0">Date</strong></label>
                                    <input class="form-control" name="date" readonly="" value="{{date('d/m/Y')}}">
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12" data-children-count="1">
                                    <label><strong data-children-count="0">Select service
                                            Method</strong></label>
                                    <select class="form-control" name="paid_service_id">
                                        @foreach ($paid_services as $paid_service)
                                        <option value="{{$paid_service->id}}">{{$paid_service->title}}
                                            ( {{$paid_service->price}} Rupee )</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="reservation_id" value="{{$reservation->id}}" type="number">
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12" data-children-count="1">
                                    <label><strong data-children-count="0">Quantity</strong></label>
                                    <input class="form-control" name="quantity" value="" placeholder="0" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
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
            {{-- <li class="nav-item">
                    <a class="nav-link" href="#print" role="tab" data-toggle="tab" aria-selected="false">Print View</a>
                </li> --}}
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
                            GSTIN: {{$hotel->gst_number}} <br>
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
                                    <td> {{ date('d-M-y', strtotime($reservation->check_in)) }}</td>
                                </tr>
                                <tr>
                                    <th><b>Check out</b></th>
                                    <th>:</th>
                                    <td>{{ date('d-M-y', strtotime($reservation->check_out)) }}</td>
                                </tr>
                                <tr>
                                    <th><b>Payment Status </b></th>
                                    <th>:</th>
                                    <td>
                                        @if(($reservation->total_plus_tax - $reservation->total_paid) <= 0) <span
                                            class="badge badge-success">Paid</span>
                                            @else
                                            <span class="badge badge-info">Due</span>
                                            @endif
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
                                    <td>#</td>
                                    <td>{{ date('d-M-y', strtotime($reservation->created_at)) }}</td>
                                    <td>
                                        <div>
                                            @foreach ($reservation->reservation_room as $room)


                                            <span class="badge badge-pill badge-success">
                                                {{$room->room->number}}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td align="right">{{$reservation->total}} Rupee</td>
                                </tr>
                                <tr class="border-top">
                                    <td colspan="3"><b>Total Price</b></td>
                                    <td align="right"> <b> {{$reservation->total}} Rupee</b></td>
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
                                        <td colspan="3" align=""><b>Extra</b></td>
                                        <td class="text-right"><b>
                                                {{$extra}} Rupee</b></td>
                                    </tr>


                                    <tr>
                                        <td colspan="3" align=""><b>Total Tax</b></td>
                                        <td class="text-right"><b>{{$reservation->total_tax}} Rupee</b></td>
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
                                        <td class="text-right"><b>{{$reservation->total_plus_tax + $extra}} Rupee</b>
                                        </td>
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
                                    @foreach ($reservation->payment as $payment)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$payment->created_at}}</td>
                                        <td>{{$payment->transaction_id}}</td>
                                        <td>{{$payment->method}}</td>
                                        <td class="text-right"> {{$payment->amount}} Rupee</td>
                                    </tr>
                                    @endforeach
                                    <tr class="border-top">
                                        <td colspan="4" align=""><b>Total Payment</b></td>
                                        <td class="text-right"><b>{{ $reservation->total_paid}} Rupee</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align=""><b>Due</b></td>
                                        <td class="text-right">
                                            <b>{{$reservation->total_plus_tax - $reservation->total_paid}} Rupee</b>
                                        </td>
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
                                @foreach ($reservation->payment as $payment)
                                <tr>
                                    <td>1</td>
                                    <td>{{$payment->created_at}}</td>
                                    <td>{{$payment->transaction_id}}</td>
                                    <td>{{$payment->method}}</td>
                                    <td class="text-right"> {{$payment->amount}} Rupee</td>
                                </tr>
                                @endforeach
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
                        @if (count($reservation->reservation_room)>0)
                        @foreach ($reservation->reservation_room as $key=>$room)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$room->created_at}}</td>
                            <td>{{$room->room->number}}</td>
                            <td>
                                {{$room->room->floor->name}}
                            </td>
                            <td class="text-right">
                                <form action="{{route('reservation.room.delete', $room->id)}}" method="post" id="rooms">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
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
                        @if (count($reservation->service) > 0)
                        @foreach ($reservation->service as $key=>$service)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$service->created_at}}</td>
                            <td>{{$service->paid_service->title}}</td>
                            <td class="text-center">
                                {{$service->quantity}}
                            </td>
                            <td class="text-right">
                                {{$service->paid_service->price }}
                            </td>
                            <td class="text-right">
                                {{$service->paid_service->price * $service->quantity}}
                            </td>
                            <td class="text-right">
                                <form action="{{route('service.destroy', $service->id)}}" method="post" id="rooms">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- <div role="tabpanel" class="tab-pane fade" id="print">
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
                                GSTIN:29AFRPP7885A1ZQ
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
                                        @foreach ($reservation->payment as $payment)
                                        <tr>
                                            <td>1</td>
                                            <td>{{$payment->created_at}}</td>
            <td>{{$payment->transaction_id}}</td>
            <td>{{$payment->method}}</td>
            <td class="text-right"> {{$payment->amount}} Rupee</td>
            </tr>
            @endforeach
            <tr class="border-top">
                <td colspan="4" align=""><b>Total Payment</b></td>
                <td class="text-right"><b>{{$reservation->total_paid}} Rupee</b></td>
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
                    <td align="right">
                        <b>{{$reservation->total_plus_tax - $reservation->total_paid}} Rupee</b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
--}}


@endsection

@section('scripts')

@endsection