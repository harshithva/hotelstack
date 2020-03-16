@extends('backend.admin.master')
@section('title','Floors')
@section('main')
<div class="container py-4">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Floors
                <a class="btn btn-success float-right" href="{{ route('floors.create') }}"><i class="fa fa-plus"></i>&nbsp;Add Floor</a>
                </h2>
                </div>
                
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
                        <th scope="col" class="sort" data-sort="budget">Name</th>
                        <th scope="col" class="sort" data-sort="status">Number</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="sort" data-sort="completion">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if (count($floors)>0)
                @foreach ($floors as $floor)
                    
           
                <tr>
                    <td>1</td>
                    <td>{{$floor->name}}</td>
                    <td>{{$floor->number}}</td>
                    <td>{{$floor->description}}</td>

                    @if ($floor->status == 1)
                    <td><span class="badge badge-success">Active</span></td>
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    @endif
                  
                    
                    <td >
                            <a href="{{ route('floors.edit', $floor->id) }}">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>  
                            <br>
                        <a href="{{ route('floors.destroy', $floor->id) }}" class="text-danger">
                                <i class="fas fa-trash-alt"></i>&nbsp;Delete
                            </a>  
                    </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
        
        </div>
    
</div>

@endsection