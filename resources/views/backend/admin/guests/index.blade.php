@extends('backend.admin.master')
@section('title', 'Guests')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Guests
                <a class="btn btn-success float-right" href="{{ route('guests.create') }}"><i class="fa fa-plus"></i>&nbsp;Add Guest</a>
                </h2>
                </div>

                @if (Session::has('message'))

                <div class="alert alert-success mt-2">{{ Session::get('message') }}</div>
 
                 @endif

                 @if (Session::has('danger'))

                 <div class="alert alert-danger mt-2">{{ Session::get('danger') }}</div>
  
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

          

            <table class="table align-items-center overflow-hidden">
                         <!-- Search form -->
            <form class="navbar-search navbar-search-light form-inline mr-sm-3 mt-3" id="navbar-search-main" method="POST" action="{{ route('guests.search')}}">
              @csrf
              <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
              <input class="form-control" placeholder="Search" type="text" name="q" value="{{ $q ?? ""}}">
                <button type="submit" class="btn btn-default">Search</button>
              </div>
            </div>

            {{-- <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close"> --}}
              {{-- <span aria-hidden="true">×</span> --}}
            {{-- </button> --}}
          </form>
              
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Sl. No.</th>
                        <th scope="col" class="sort" data-sort="budget">Full Name</th>
                        <th scope="col" class="sort" data-sort="status">Email</th>
                        <th scope="col" class="sort" data-sort="status">Phone</th>
                        <th scope="col" class="sort" data-sort="status">VIP</th>
                        <th scope="col" class="sort" data-sort="completion">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if (count($guests) > 0)
                @foreach ($guests as $key => $guest)
                    
           
                <tr>
                <td>{{ ($key + 1) }}</td>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->email}}</td>
                    <td>{{ $guest->phone}}</td>

                    
                    @if ($guest->vip == 1)
                    <td><span class="badge badge-success">YES</span></td>
                    @else
                    <td><span class="badge badge-danger">NO</span></td>
                    @endif
                    
                    @if ($guest->status == 1)
                    <td><span class="badge badge-success">Active</span></td>
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    @endif
                  
                    
                    <td >
                            <a href="{{ route('guests.edit', $guest->id) }}">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>  
                            <br>
                                
                                <form action="{{ route('guests.destroy', $guest->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <span class="text-danger">
                                        <i class="fas fa-trash-alt"></i>&nbsp; <button class="text-danger" type="submit" style="background:none!important;border:none;padding:0!important;">Delete</button>
                                    </span>
                                  </form>
                         
                            <a href="{{ route('guests.edit', $guest->id) }}">
                                <i class="fas fa-bookmark"></i>&nbsp;Reservation
                            </a>  
                            <br>

                    </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
        
        <div class="row">
            <div class="col-12 d-flex justify-content-center">{{ $guests->links() }}</div>
            </div>

        </div>
    </div>

@endsection