@extends('backend.admin.master')
@section('title','Edit Check in')
@section('main')

<div class="main-content p-4" id="panel">
    <div id="app">

        <div class="card">
            <div class="card-header bg-white">
                <h2>Edit Check in
                    <a class="btn btn-tsk float-right" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i>
                        Return Back</a>
                </h2>
            </div>


            <div class="card-body">
                <form action="{{ route('guests.store') }}" method="post" enctype="multipart/form-data"><input
                        type="hidden">
                    @csrf

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
                        <label for="exampleFormControlInput1">Guest</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="">Adults</label>
                            <input type="text" class="form-control" placeholder="First name">
                        </div>
                        <div class="col">
                            <label for="">Kids</label>
                            <input type="text" class="form-control" placeholder="Last name">
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
                                    <input value="{{ $reservation->check_in }}" name="check_in"
                                        class="form-control datepicker" placeholder="Select date" type="text">
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
                                    <input value="{{ $reservation->check_out }}" name="check_out"
                                        class="form-control datepicker" placeholder="Select date" type="text">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection