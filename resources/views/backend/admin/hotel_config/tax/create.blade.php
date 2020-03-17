@extends('backend.admin.master')
@section('title','Add Tax')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="card">
        <div class="card-header bg-white">
        <h2>Add Tax
        <a class="btn btn-tsk float-right" href="{{ route('tax.index') }}"><i class="fa fa-list"></i> Tax List</a>
        </h2>
        </div>


        <div class="card-body">
        <form action="{{ route('tax.store') }}" method="post" enctype="multipart/form-data"><input type="hidden" >
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

        <div class="form-row justify-content-center">

        <div class="form-group col-md-6">
        <label><strong>Tax Name</strong> <small class="text-danger">*</small></label>
        <input type="text" class="form-control form-control-lg" name="name" placeholder="Tax Name" required>
        </div>

        <div class="form-group col-md-6">
            <label><strong>Code</strong> (optional)</label>
            <input type="text" class="form-control form-control-lg" name="code" placeholder="Code">
            </div>

        </div>
        
        <div class="form-row justify-content-left">

        <div class="form-group col-md-4">
            <label><strong>For</strong> <small class="text-danger">*</small></label>
            <input type="number" class="form-control form-control-lg" name="amount_1" placeholder="Enter Amount" required>
            </div>

            <div class="form-group col-md-4">
                <label><strong>Rate (percent)</strong> <small class="text-danger">*</small></label>
                <input type="number" class="form-control form-control-lg" name="rate_1" placeholder="Percentage" required>
                </div>
    
            </div>

            <div class="form-row justify-content-left">

                <div class="form-group col-md-4">
                    <label><strong>For</strong></label>
                    <input type="number" class="form-control form-control-lg" name="amount_2" placeholder="Enter Amount">
                    </div>
        
                    <div class="form-group col-md-4">
                        <label><strong>Rate (percent)</strong></label>
                        <input type="number" class="form-control form-control-lg" name="rate_2" placeholder="Percentage">
                        </div>
            
                    </div>
    
            
        
        <div class="form-row justify-content-center">
        <div class="form-group col-sm-12">
            
        <h3>Status</h3>
        <label class="custom-toggle">
            <input id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
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