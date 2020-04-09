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

        <form action="{{ route('reservations.rooms.select', $guest->id) }}" method="POST">
            @csrf
            {{-- <div class="form-group">
                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-lg">Guest Name</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg" value="{{ $guest->name }}" name="guest">
            <input type="hidden" value="{{$guest->id}}" name="user_id" />
    </div>
</div> --}}
<reservation guest-name="{{$guest->name}}" guest-id="{{$guest->id}}" guest-adults="{{$guest->adults}}"
    guest-kids="{{$guest->kids}}" guest-check-in="{{$guest->check_in}}" guest-check-out="{{$guest->check_out}}">
</reservation>

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


{{-- 
            <div class="form-row justify-content-center">
         
</div>

</div> --}}

<tbody>
    <tr>

        <td class="price-per-night p-0">
            <table class="table table-sm borderless mb-0 ">
                <thead class="font-weight-bold">
                    <div id="app">

                    </div>
                    <tr>
                        <td class="sl">#</td>
                        <td>Room type</td>
                        <td>Available Rooms</td>
                        <td>Tax</td>
                        <td class="text-right">Price/Night</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roomTypes as $roomType)
                    <tr>
                        <td class="sl">1.</td>
                        <td class="text-muted">{{$roomType->title}}</td>
                        <td>
                            <div>

                                @if (count($roomType->rooms) > 0)
                                @foreach ($roomType->rooms as $rooms)
                                {{-- 
                                            <button :class="classname" id="custom{{ $rooms->number}}"
                                @click.stop.prevent="selectRoom">{{ $rooms->number}}</button> --}}

                                <select-rooms room="{{$rooms->number}}" v-on:select-room="selectRoom"></select-rooms>
                                @endforeach
                                @endif
                            </div>
                        </td>

                        <td>
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected disabled>Choose...</option>
                                <option value="no_tax">No tax</option>
                                @foreach ($taxes ?? '' as $tax)


                                <option value="{{$tax->id}}">{{$tax->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="float-right">
                            <div class="col-md-7">

                            </div>
                            <div class="col-md-5 float-right">
                                <span class="d-inline h3">₹&nbsp;</span><input type="text" name="" id=""
                                    class="form-control d-inline" value="{{$roomType->base_price}}">
                            </div>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </td>
    </tr>
    <tr>




        <input type="hidden" name="rooms[]" v-model="selected">




        <button class="btn btn-success btn-lg btn-block mt-3" type="submit">Next</button>
        </form>
        {{-- <select-rooms-details room-types="{{$roomTypes}}" taxes="{{$taxes}}">
        @if (count($roomType->rooms) > 0)
        @foreach ($roomType->rooms as $rooms)
        <slot>
            <select-rooms room="{{$rooms->number}}"></select-rooms>
        </slot>
        @endforeach
        @endif
        </select-rooms-details> --}}
        </div>
        </div>


        @endsection

        @section('scripts')

        @endsection