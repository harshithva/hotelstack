@extends('backend.admin.master')
@section('title','Add Rooms')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="card">
        <div class="card-header bg-white">
        <h2>Edit Room
        <a class="btn btn-tsk float-right" href="{{ route('rooms.index') }}"><i class="fa fa-list"></i> Floor List</a>
        </h2>
        </div>


        <div class="card-body">
        <form action="{{ route('rooms.update', $room->id) }}" method="post" enctype="multipart/form-data"><input type="hidden" >
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                 @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                 @endforeach
                </ul>
              </div>
              @endif

        <div class="form-row justify-content-center">
        <div class="form-group col-md-12">
        <label><strong>Number</strong> <small class="text-danger">*</small></label>
        <input value="{{$room->number}}" type="text" class="form-control form-control-lg" name="number" placeholder="Room number" required>
        </div>
        </div>

        <div class="form-row justify-content-center">
    
            <div class="form-group col-md-6">
                <label><strong>Floor</strong> <small class="text-danger">*</small></label>
                <select value="{{$room->floor_id}}" name="floor_id" class="form-control" id="exampleFormControlSelect1">
                  @if ($floors)
                  @foreach ($floors as $floor)
                  <option value="{{ $floor->id }}">{{ $floor->name }}</option>
                  @endforeach
                  @endif
                </select>
              </div>

              <div class="form-group col-md-6">
                <label><strong>Room Type</strong> <small class="text-danger">*</small></label>
                <select value="{{$room->room_type_id}}" name="room_type_id" class="form-control" id="exampleFormControlSelect1">
                  @if ($room_types)
                  @foreach ($room_types as $room_type)
                <option value="{{ $room_type->id }}">{{ $room_type->title }}</option>
                  @endforeach
                  @endif
                </select>
              </div>
        </div>

        <div class="form-row justify-content-center">
    
            <div class="form-group col-md-12">
                <label><strong>Room Image</strong> <small class="text-danger">*</small></label>
                <div class="custom-file">
                  <input value="{{$room->image}}" type="file" name="image" class="custom-file-input" id="customFileLang" lang="en" enctype="multipart/form-data">
                  <label class="custom-file-label" for="customFileLang">Select file</label>
                </div>
            </div>
        </div>
        
        <div class="form-row justify-content-center">
        <div class="form-group col-sm-12">
            
        <h3>Status</h3>
        <label class="custom-toggle">
            <input value="{{$room->status}}" id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
            <span class="custom-toggle-slider rounded-circle" data-label-off="off" data-label-on="on"></span>
        </label>
        </div>
        <div class="form-row justify-content-center">
        <div class="form-group col-sm-12">
        <hr>
        
        </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i>Save</button>
        </form>
        </div>
        </div>
    
</div>

@endsection