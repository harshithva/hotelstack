@extends('backend.admin.master')
@section('title','Rooms')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Rooms
                <a class="btn btn-success float-right" href="{{ route('rooms.create') }}"><i class="fa fa-plus"></i>&nbsp;Add Room</a>
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
                        <th scope="col" class="sort" data-sort="budget">Room Number</th>
                        <th scope="col" class="sort" data-sort="status">Room Type</th>
                        <th scope="col">Floor Number</th>
                        <th scope="col" class="sort" data-sort="completion">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if (count($rooms) > 0)
                @foreach ($rooms as $key => $room)
                    
           
                <tr>
                <td>{{ ($key + 1) }}</td>
                    <td>{{ $room->number }}</td>
                    <td>{{ optional($room->type)->title }}</td>
                    <td>{{ optional($room->floor)->number }}</td>

                    @if ($room->status == 1)
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    @endif
                  
                    
                    <td >
                            <a href="{{ route('rooms.edit', $room->id) }}">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>  
                            <br>
                                
                                <form action="{{ route('rooms.destroy', $room->id)}}" method="post">
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
        
        <div class="row">
            <div class="col-12 d-flex justify-content-center">{{ $rooms->links() }}</div>
            </div>

        </div>
    </div>

@endsection