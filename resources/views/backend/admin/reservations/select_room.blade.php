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
                    <span>60%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                    aria-valuemax="100" style="width: 60%;"></div>
            </div>
        </div>

        <form action="{{ route('reservations.rooms', $guest->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-lg">Guest Name</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg" value="{{ $guest->name }}" name="guest">
                    <input type="hidden" value="{{$guest->id}}" name="user_id" />
                </div>
            </div>

            {{-- 
            <select class="form-control form-control-lg">
                <option>Select Room Type</option>
                @foreach ($room_types as $room_type)
                @if ($selected_type == $room_type)
                <option value="{{$room_type->id}}" selected="true">{{$room_type->title}}</option>
            @else
            <option value="{{$room_type->id}}" disabled="disabled">{{$room_type->title}}</option>
            @endif

            @endforeach
            </select> --}}

            <div class="form-row justify-content-center mt-3">

                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="example-number-input" class="form-control-label">&nbsp;Adults</label>
                        <input class="form-control" type="number" id="example-number-input" name="adults"
                            value="{{$guest->adults}}">
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="example-number-input" class="form-control-label">&nbsp;Kids</label>
                        <input class="form-control" type="number" id="example-number-input" name="kids"
                            value="{{$guest->kids}}">
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <h5>&nbsp;Check in</h5>
                    <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input name="check_in" class="form-control datepicker" placeholder="Select date" type="text"
                                value="{{$guest->check_in}}">
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <h5>&nbsp;Check out</h5>
                    <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input name="check_out" class="form-control datepicker" placeholder="Select date"
                                type="text" value="{{$guest->check_out}}">
                        </div>
                    </div>
                </div>

            </div>
            {{-- 
            <div class="form-row justify-content-center">
         
</div>

</div> --}}

            <tbody>
                <tr>

                    <td class="price-per-night p-0">
                        <table class="table table-sm borderless mb-0 ">
                            <thead class="font-weight-bold">
                                <tr>
                                    <td class="sl">#</td>
                                    <td>Room type</td>
                                    <td>Available Rooms</td>
                                    <td>Tax</td>
                                    <td class="text-right">Price/Night</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="sl">1.</td>
                                    <td class="text-muted">Superior Room</td>
                                    <td>
                                        <div><a class="btn btn-sm btn-tsk">
                                                104
                                            </a><a class="btn btn-sm btn-outline-secondary">
                                                205
                                            </a><a class="btn btn-sm btn-outline-secondary">
                                                209
                                            </a><a class="btn btn-sm btn-outline-secondary">
                                                211
                                            </a></div>
                                    </td>

                                    <td>
                                        <select class="custom-select" id="inputGroupSelect01">
                                            <option selected disabled>Choose...</option>
                                            <option value="no_tax">No tax</option>
                                            @foreach ($taxes ?? '' as $tax)

                                            @endforeach
                                            <option value="{{$tax->id}}">{{$tax->name}}</option>

                                        </select>
                                    </td>
                                    <td class="float-right">
                                        <div class="col-md-7">

                                        </div>
                                        <div class="col-md-5 float-right">
                                            <span class="d-inline h3">₹&nbsp;</span><input type="text" name="" id=""
                                                class="form-control d-inline" value="999">
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>


                    </td>
                </tr>
                <!---->
            </tbody>

            <button class="btn btn-success btn-lg btn-block mt-3" type="submit">Next</button>
        </form>
    </div>
</div>


@endsection