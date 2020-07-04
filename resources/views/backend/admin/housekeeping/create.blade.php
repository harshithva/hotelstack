@extends('backend.admin.master')
@section('title','Create Housekeeping')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="card">
        <div class="card-header bg-white">
            <h2>Add to Housekeeping
                <a class="btn btn-tsk float-right" href="{{ route('housekeeping.index') }}"><i class="fa fa-list"></i>
                    Housekeeping List</a>
            </h2>
        </div>


        <div class="card-body">
            <form action="{{ route('housekeeping.store') }}" method="post"><input type="hidden">
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

                <div class="form-row">
                    <label for="room">Room</label>
                    <select class="custom-select" name="room_id">
                        <option selected>Select Room</option>
                        @foreach ($rooms as $room)
                        <option value="{{$room->id}}">{{$room->number}}</option>
                        @endforeach

                    </select>
                </div>


                <div class="form-group mt-3">
                    <label>Cleaned By</label>
                    <input value="{{ old('cleaned_by') }}" type="text" class="form-control" name="cleaned_by"
                        placeholder="Cleaned By">
                </div>

                <div class="form-group mt-3">
                    <label for="status">status</label>
                    <select class="custom-select" name="status">
                        <option selected>Select Status</option>
                        <option value="0" selected>In Progress</option>
                        <option value="1">Done</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </form>
        </div>
    </div>

</div>

@endsection