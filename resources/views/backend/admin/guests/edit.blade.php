@extends('backend.admin.master')
@section('title','Create new guest')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="card">
        <div class="card-header bg-white">
        <h2>Edit Guest
        <a class="btn btn-tsk float-right" href="{{ route('guests.index') }}"><i class="fa fa-list"></i> Floor List</a>
        </h2>
        </div>


        <div class="card-body">
        <form action="{{ route('guests.update', $guest->id) }}" method="post" enctype="multipart/form-data"><input type="hidden" >
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
        <label><strong>First Name</strong> <small class="text-danger">*</small></label>
        <input value="{{ $guest->name }}" type="text" class="form-control form-control-lg" name="name" placeholder="First name" required>
        </div>

        <div class="form-group col-md-6">
            <label><strong>Last Name</strong> <small class="text-danger">*</small></label>
            <input value="{{ $guest->last_name }}" type="text" class="form-control form-control-lg" name="last_name" placeholder="Last name">
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-4">
            <label><strong>Password</strong> <small class="text-danger">*</small></label>
            <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
            </div>
    
            <div class="form-group col-md-4">
                <label><strong>Email</strong> <small class="text-danger">*</small></label>
                <input value="{{ $guest->email }}" type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
                </div>

                <div class="form-group col-md-4">
                    <label><strong>Phone</strong> <small class="text-danger">*</small></label>
                    <input value="{{ $guest->phone }}" type="number" class="form-control form-control-lg" name="phone" placeholder="Phone" required>
                    </div>
            </div>
        
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label><strong>Sex</strong> <small class="text-danger">*</small></label>
                    <select value="{{ $guest->sex }}" name="sex" class="form-control" id="exampleFormControlSelect1">
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                      <option value="O">Other</option>    
                    </select>
                </div>
        
                <div class="form-group col-md-8">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Address</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="address">{{ $guest->address }}</textarea>
                      </div>
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                    <label><strong>Type of ID</strong> <small class="text-danger">*</small></label>
                    <input value="{{ $guest->id_type }}" name="id_type" type="text" class="form-control form-control-lg" placeholder="ID Type">
                    </div>
            
                    <div class="form-group col-md-4">
                        <label><strong>ID NO</strong> <small class="text-danger">*</small></label>
                        <input value="{{ $guest->id_number }}" type="text" class="form-control form-control-lg" name="id_number" placeholder="ID Number">
                        </div>
        
                        <div class="form-group col-md-4">
                            <label>Upload ID Card<strong></strong> <small class="text-danger">*</small></label>
                            <div class="custom-file">
                                <input value="{{ $guest->id_card_image }}" type="file" name="id_card_image" class="custom-file-input" id="customFileLang" lang="en" enctype="multipart/form-data">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                              </div>
                    </div>
                </div>

     <div class="form-row justify-content-center mt-3">
        <div class="form-group col-md-4">  
            <h3>Date of Birth</h3>       
            <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input value="{{ $guest->dob }}" name="dob" class="form-control datepicker" placeholder="Select date" type="text">
                </div>
            </div>
        </div>

        <div class="form-group col-md-4 mt-3 text-center">  
            <h3>VIP</h3>
            <label class="custom-toggle">
                <input value="{{ $guest->vip }}" name="vip" id="status" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle">
                <span class="custom-toggle-slider rounded-circle" data-label-off="off" data-label-on="on"></span>
            </label>
            </div>

            <div class="form-group col-md-4 mt-4 text-center"> 
                <h3>Status</h3>
        <label class="custom-toggle">
            <input value="{{ $guest->status }}" name="status" id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle">
            <span class="custom-toggle-slider rounded-circle" data-label-off="off" data-label-on="on"></span>
        </label>
      </div>

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