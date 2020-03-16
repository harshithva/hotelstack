@extends('backend.admin.master')
@section('title','Room types')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Room Types
                <a class="btn btn-success float-right" href="{{ route('room_types.create') }}"><i class="fa fa-plus"></i>&nbsp;Add Room Type</a>
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

              @if ($message ?? '')
              <div class="alert alert-success mt-3">
                <ul>
                <li>{{$message ?? ''}}</li>
                </ul>
              </div>
          @endif

            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Sl. No.</th>
                        <th scope="col" class="sort" data-sort="budget">Title</th>
                        <th scope="col" class="sort" data-sort="status">Short Code</th>
                        <th scope="col">Price</th>
                        <th scope="col" class="sort" data-sort="status">Total Room</th>
                        <th scope="col" class="sort" data-sort="completion">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if (count($room_types)>0)
           @foreach ($room_types as $room_type)
                    
           
                <tr>
                    <td>1</td>
                    <td>{{$room_type->title}}</td>
                    <td>{{ Str::upper($room_type->short_code) }}</td>
                    <td>{{$room_type->base_price}}</td>
                    <td>10</td>
                    @if ($room_type->status == 1)
                    <td><span class="badge badge-success">Active</span></td>
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    @endif
                  
                    
                    <td >
                            <a href="{{ route('room_types.edit', $room_type->id) }}">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>  
                            <br>
                                
                                <form action="{{ route('room_types.destroy', $room_type->id)}}" method="post">
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