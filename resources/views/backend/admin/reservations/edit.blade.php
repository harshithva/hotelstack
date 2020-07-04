@extends('backend.admin.master')
@section('title','Edit Reservation')
@section('main')

<div class="main-content p-4" id="panel">
    <div id="app">

        <div class="card">
            <div class="card-header bg-white">
                <h2>Edit Reservation
                    <a class="btn btn-tsk float-right" href="{{ route('reservations.show',$reservation->id) }}"><i
                            class="fa fa-arrow-left"></i>
                        Return Back</a>
                </h2>
            </div>


            <div class="card-body">
                @if (Session::has('reservation_update'))

                <div class="alert alert-success mt-2">{{ Session::get('reservation_update') }}</div>

                @endif
                <form action="{{ route('reservations.update',$reservation->id) }}" method="post"
                    enctype="multipart/form-data"><input type="hidden">
                    @csrf
                    @method('PATCH')
                    @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#add_room">
                            Edit Room
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Guest ID</label>

                        <input type="text" class="form-control" name="user_id" list="browsers6" autocomplete="off"
                            required="required" placeholder="Search Customer" value="{{$reservation->user_id}}" />
                        <datalist id="browsers6">
                            @foreach ($guests as $guest)
                            <option value="{{$guest->id}}">
                                {{$guest->name}}</option>
                            @endforeach

                        </datalist>
                        </select>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <label for="">Adults</label>
                            <input type="text" class="form-control" name="adults" value="{{$reservation->adults}}"
                                required>
                        </div>
                        <div class="col">
                            <label for="">Kids</label>
                            <input type="text" class="form-control" name="kids" value="{{$reservation->kids}}" required>
                        </div>
                    </div>

                    <div class="form-row justify-content-center mt-3">
                        <div class="form-group col-md-6">
                            <label>Check in</label>
                            <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input value="{{ date("d/m/Y", strtotime($reservation->check_in))  }}"
                                        name="check_in" class="form-control datepicker" placeholder="Select date"
                                        type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Check out</label>
                            <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input value="{{ date("d/m/Y", strtotime($reservation->check_out))  }}"
                                        name="check_out" class="form-control datepicker" placeholder="Select date"
                                        type="text" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="">Check in status</label>
                            <select class="custom-select" name="checked_in" required>
                                <option disabled>Open this select menu</option>
                                <option value="1" {{ $reservation->checked_in == 1 ? 'selected' : ''}}>True</option>
                                <option value="0" {{ $reservation->checked_in == 0 ? 'selected' : ''}}>False</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Check out status</label>
                            <select class="custom-select" name="checked_out" required>
                                <option disabled>Open this select menu</option>
                                <option value="1" {{ $reservation->checked_out == 1 ? 'selected' : ''}}>True</option>
                                <option value="0" {{ $reservation->checked_out == 0 ? 'selected' : ''}}>False</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row mt-4">
                        <div class="col-md-3">
                            <label for="">Total</label>
                            <input type="text" class="form-control" name="total" value="{{$reservation->total}}"
                                required>
                        </div>
                        {{-- <div class="col">
                            <label for="">Tax</label>
                            <input type="text" class="form-control" name="total_tax" value="{{$reservation->total_tax}}"
                        required>
                    </div> --}}
                    {{-- <div class="col">
                            <label for="">Total + Tax</label>
                            <input type="text" class="form-control" name="total_plus_tax"
                                value="{{$reservation->total_plus_tax}}" required>
            </div> --}}


        </div>

        {{-- Add room--}}

        <button type="submit" class="btn btn-primary mt-4">Update</button>
        </form>
    </div>
</div>
</div>
</div>


@include('backend.admin.includes.add_room')
@endsection