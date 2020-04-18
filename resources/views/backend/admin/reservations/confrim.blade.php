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
                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                    aria-valuemax="100" style="width: 90%;"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h2>Create Reservation
                    <a href="https://whitehouseinn.in/admin/reservations" class="btn btn-tsk float-right"><i
                            class="fa fa-list"></i> Reservation List</a></h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class=" mb-3">
                            <div class="form-row justify-content-center " style="display: none;">
                                <div class="form-group col-md-4"><label><strong>Guest</strong> <small
                                            class="text-danger">*</small></label><a
                                        href="https://whitehouseinn.in/admin/guests/create" target="_blank"
                                        class="float-right"><i class="fa fa-plus"></i> add new</a> <select id="guest"
                                        name="guest" class="form-control form-control-lg">
                                        <option value="">Select</option>
                                        <option value="1">LIKITH POOJARY</option>

                                    </select>
                                    <!---->
                                </div>
                                <div class="form-group col-md-4"><label><strong>Room</strong> <small
                                            class="text-danger">*</small></label> <select id="room_type" name="room"
                                        class="form-control form-control-lg">
                                        <option value="">Select</option>
                                        <option value="1">Superior Room</option>
                                        <option value="2">Deluxe Room</option>
                                        <option value="3">Standard Deluxe Room</option>
                                        <option value="4">Super Deluxe Room</option>
                                    </select>
                                    <!---->
                                </div>
                                <div class="form-group col-md-2"><label><strong>Adults</strong></label> <input
                                        type="number" class="form-control form-control-lg"> <small
                                        class="form-text text-info">Max Capacity 2/per room</small>
                                    <!---->
                                </div>
                                <div class="form-group col-md-2"><label><strong>Kids</strong></label> <input
                                        type="number" class="form-control form-control-lg"> <small
                                        class="form-text text-info">Max Capacity 2/per room</small></div>
                            </div>
                            <div class="form-row justify-content-center " style="display: none;">
                                <div class="form-group col-md-6"><label><strong>Check in</strong> <small
                                            class="text-danger">*</small></label>
                                    <div role="wrapper"
                                        class="gj-datepicker gj-datepicker-bootstrap gj-unselectable input-group"><input
                                            type="text" name="check_in" id="check_in" placeholder="YYYY/MM/DD"
                                            class="form-control" role="input" data-type="datepicker"
                                            data-guid="d4ec4aea-5ca1-c277-b528-282e1a3bff8f"
                                            data-datepicker="true"><span class="input-group-append"
                                            role="right-icon"><button class="btn btn-outline-secondary border-left-0"
                                                type="button"><i class="fa fa-calendar"
                                                    aria-hidden="true"></i></button></span></div>
                                    <!---->
                                </div>
                                <div class="form-group col-md-6"><label><strong>Check out</strong> <small
                                            class="text-danger">*</small></label>
                                    <div role="wrapper"
                                        class="gj-datepicker gj-datepicker-bootstrap gj-unselectable input-group"><input
                                            type="text" name="check_out" id="check_out" placeholder="YYYY/MM/DD"
                                            class="form-control" role="input" data-type="datepicker"
                                            data-guid="d1f0534a-4d68-1b49-3e05-bfda23ffa736"
                                            data-datepicker="true"><span class="input-group-append"
                                            role="right-icon"><button class="btn btn-outline-secondary border-left-0"
                                                type="button"><i class="fa fa-calendar"
                                                    aria-hidden="true"></i></button></span></div>
                                    <!---->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row mb-4">
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Rooms</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>1</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Adults</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>1</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Kids</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>0</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h3>Nights</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>1</h3>
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
                            </ @endsection @section('scripts') @endsection