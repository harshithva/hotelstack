@extends('backend.admin.master')
@section('title','Edit Paid Service')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="card">
        <div class="card-header bg-white">
        <h2>Edit Paid Service
        <a class="btn btn-tsk float-right" href="{{ route('paid_services.index') }}"><i class="fa fa-list"></i> Paid Service List</a>
        </h2>
        </div>


        <div class="card-body">
        <form action="{{ route('paid_services.update', $paidService->id) }}" method="post" enctype="multipart/form-data"><input type="hidden" >
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
        <input value="{{ $paidService->title }}" type="text" class="form-control form-control-lg" name="title" placeholder="Title" required>
        </div>

        <div class="form-group col-md-6">
        <label><strong>Price</strong> <small class="text-danger">*</small></label>
        <input value="{{ $paidService->price }}" type="number" class="form-control form-control-lg" name="price" placeholder="Price" value="" required>
        </div>
        </div>

        <div class="form-row justify-content-center">
        <div class="form-group col-md-12">
        <label><strong>Description</strong><small> (optional)</small> </label>
        <textarea class="form-control form-control-lg" rows="4" name="short_desc" placeholder="Description">{{ $paidService->short_desc }}</textarea>
        </div>
        </div>
        
        <div class="form-row justify-content-center">
        <div class="form-group col-sm-12">
            
        <h3>Status</h3>
        <label class="custom-toggle">
            <input value="{{ $paidService->status }}" id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
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