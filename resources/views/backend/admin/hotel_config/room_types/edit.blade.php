@extends('backend.admin.master')
@section('title','Add Floors')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="card">
        <div class="card-header bg-white">
        <h2>Edit Room Type
        <a class="btn btn-tsk float-right" href="{{ route('room_types.index') }}"><i class="fa fa-list"></i> Floor List</a>
        </h2>
        </div>


        <div class="card-body">
        <form action="{{ route('room_types.update', $roomType->id) }}" method="post" enctype="multipart/form-data"><input type="hidden" >
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
        <div class="form-group col-md-6">
        <label><strong>Title</strong> <small class="text-danger">*</small></label>
        <input type="text" class="form-control form-control-lg" name="title" placeholder="Floor name" value="{{ $roomType->title }}" required>
        </div>

        <div class="form-group col-md-6">
        <label><strong>Short Code</strong> <small class="text-danger">*</small></label>
        <input type="text" class="form-control form-control-lg" name="short_code" placeholder="Short Code" value="{{ $roomType->short_code}}" required>
        </div>
        </div>

        <div class="form-row justify-content-center">
        <div class="form-group col-md-12">
        <label><strong>Description</strong><small> (optional)</small> </label>
        <textarea class="form-control form-control-lg" rows="4" name="description" placeholder="Description" value="{{ $roomType->description}}"></textarea>
        </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-4">
            <label><strong>Max Capacity</strong> <small class="text-danger">*</small></label>
            <input type="number" class="form-control form-control-lg" name="higher_capacity" placeholder="Max Capacity" value="{{ $roomType->higher_capacity}}" required>
            </div>
    
            <div class="form-group col-md-4">
            <label><strong>Kids Capacity</strong> <small class="text-danger">*</small></label>
            <input type="number" class="form-control form-control-lg" name="kids_capacity" placeholder="Kids Capacity" value="{{ $roomType->kids_capacity}}" required>
            </div>

            <div class="form-group col-md-4">
                <label><strong>Base Price</strong> <small class="text-danger">*</small></label>
                <input type="number" class="form-control form-control-lg" name="base_price" placeholder="Base Price" value="{{ $roomType->base_price}}" required>
                </div>
            </div>
        
        <div class="form-row justify-content-center">
        <div class="form-group col-sm-12">
            
        <h3>Status</h3>
        <label class="custom-toggle">
            <input id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status" value="{{ $roomType->status}}">
            <span class="custom-toggle-slider rounded-circle" data-label-off="off" data-label-on="on"></span>
        </label>
        </div>
        <div class="form-row justify-content-center">
        <div class="form-group col-sm-12">
        <hr>
        
        </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Save</button>
        </form>
        </div>
        </div>
    
</div>

@endsection