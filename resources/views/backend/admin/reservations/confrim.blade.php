@extends('backend.admin.master')
@section('title', 'Reservation')
@section('main')
<div class="main-content p-4" id="panel">
    <div>
        <div class="card-header bg-white">
            <h2>Rooms
                <a class="btn btn-success float-right" href="{{ route('rooms.create') }}"><i
                        class="fa fa-plus"></i>&nbsp;Create Room</a>
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

        <div class="progress-wrapper">
            <div class="progress-info">
                <div class="progress-label">
                    <span>Task completed</span>
                </div>
                <div class="progress-percentage">
                    <span>90%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                    aria-valuemax="100" style="width: 90%;"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h2>Confrim Reservation
                    <a href="https://whitehouseinn.in/admin/reservations" class="btn btn-tsk float-right"><i
                            class="fa fa-list"></i> Reservation List</a></h2>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-row mb-4">
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Rooms</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->roomsCount}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Adults</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->adults}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Kids</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->kids}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Nights</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->nights}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body p-0 table-responsive">
                                        <table class="table table-sm  res-tbl mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Price Per Night</th>
                                                    <td class="price-per-night p-0">
                                                        <table class="table table-sm borderless mb-0 ">
                                                            <thead class="font-weight-bold">
                                                                <tr>
                                                                    <td class="sl">#</td>
                                                                    <td>Date</td>
                                                                    <td>Available Room</td>
                                                                    <td>Qty</td>
                                                                    <td class="text-right">Price/Night</td>
                                                                    <td class="text-right">Total Price</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="sl">1.</td>
                                                                    <td class="text-muted">2020/04/18</td>
                                                                    <td>
                                                                        <div><a class="btn btn-sm btn-tsk">
                                                                                205
                                                                            </a><a
                                                                                class="btn btn-sm btn-outline-secondary">
                                                                                209
                                                                            </a><a
                                                                                class="btn btn-sm btn-outline-secondary">
                                                                                211
                                                                            </a></div>
                                                                    </td>
                                                                    <td class="text-success">1 / 1</td>
                                                                    <td class="text-right">999 Rupee</td>
                                                                    <td class="text-right">
                                                                        999 Rupee
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Taxes</th>
                                                    <td class="p-0">
                                                        <table class="table table-sm borderless mb-0">
                                                            <tbody>
                                                                <tr class="font-weight-bold">
                                                                    <td colspan="3">Total TAX</td>
                                                                    <td class="text-right "><span
                                                                            class="border-top"><input type="hidden"
                                                                                value="0">
                                                                            0 Rupee</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!---->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row justify-content-center" style="">
                                            <div class="form-group col-md-3">
                                                <div class="card p-2">
                                                    <div class="input-group"><input type="text"
                                                            placeholder="Apply Coupon" class="form-control">
                                                        <div class="input-group-append">
                                                            <div class="input-group-btn">
                                                                <!---->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!---->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-6 mt-2"><button class="btn btn-outline-tsk float-left"><i
                                        class="fa fa-refresh"></i> Reset</button>
                                <div>
                                    <!---->
                                </div> <button class="btn btn-tsk float-right"><i class="fa fa-save"></i> Reservation
                                    Confirm</button> <button class="btn btn-danger float-right mr-1"><i
                                        class="fa fa-arrow-left"></i> Back</button>
                            </div>

                            @endsection @section('scripts') @endsection