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

        <form action="{{ route('check_in.rooms.select', $guest->id) }}" method="POST">
            @csrf

            <reservation guest-name="{{$guest->name}}" guest-id="{{$guest->id}}" guest-adults="{{$guest->adults}}"
                guest-kids="{{$guest->kids}}" guest-check-in="{{$guest->check_in}}"
                guest-check-out="{{$guest->check_out}}">
            </reservation>




            @foreach ($roomTypes as $key => $roomType)

            @if (count($roomType->rooms) > 0)
            @foreach ($roomType->rooms as $rooms)


            @endforeach
            @endif

            @endforeach




            <room-details :room-types="{{ json_encode($roomTypes) }}" :taxes="{{ json_encode($taxes) }}"
                guest-check-in="{{$guest->check_in}}" guest-check-out="{{$guest->check_out}}">

            </room-details>


            <input type="hidden" name="check_in" value="{{$guest->check_in}}">
            <input type="hidden" name="check_out" value="{{$guest->check_out}}">


            <button class="btn btn-success mt-3" type="submit">Next</button>
        </form>


    </div>
</div>


@endsection

@section('scripts')

@endsection