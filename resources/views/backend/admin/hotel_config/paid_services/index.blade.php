@extends('backend.admin.master')
@section('title','Paid Services')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Paid Services
                <a class="btn btn-success float-right" href="{{ route('paid_services.create') }}"><i class="fa fa-plus"></i>&nbsp;Add Paid Service</a>
                </h2>
                </div>
              
                @if (Session::has('message'))

                <div class="alert alert-success mt-2">{{ Session::get('message') }}</div>
 
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

          

            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Sl. No.</th>
                        <th scope="col" class="sort" data-sort="budget">Title</th>
                        <th scope="col" class="sort" data-sort="status">Price</th>
                    <th scope="col" class="sort" data-sort="completion">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if (count($paid_services) > 0)
                @foreach ($paid_services as $key => $paid_service)
                    
           
                <tr>
                <td>{{ ($key + 1) }}</td>
                    <td>{{ $paid_service->title}}</td>
                    <td>{{ $paid_service->price }}</td>

                    @if ($paid_service->status == 1)
                    <td><span class="badge badge-success">Active</span></td>
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    @endif
                  
                    
                    <td >
                            <a href="{{ route('paid_services.edit', $paid_service->id) }}">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>  
                            <br>
                                
                                <form action="{{ route('paid_services.destroy', $paid_service->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <span class="text-danger">
                                        <i class="fas fa-trash-alt"></i>&nbsp; <button class="text-danger" type="submit" style="background:none!important;border:none;padding:0!important;">Delete</button>
                                    </span>
                                  </form>
                       

                    </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
        
        </div>
    </div>

@endsection