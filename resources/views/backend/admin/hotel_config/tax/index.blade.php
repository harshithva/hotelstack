@extends('backend.admin.master')
@section('title', 'Tax')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Tax
                <a class="btn btn-success float-right" href="{{ route('tax.create') }}"><i class="fa fa-plus"></i>&nbsp;Add Tax</a>
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
                        <th scope="col" class="sort" data-sort="budget">Tax Name</th>
                        <th scope="col" class="sort" data-sort="status">Rate (percent)</th>
                        <th scope="col" class="sort" data-sort="completion">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if (count($taxes) > 0)
                @foreach ($taxes as $key => $tax)
                    
           
                <tr>
                <td>{{ ($key + 1) }}</td>
                    <td>{{ Str::upper($tax->name) }}</td>
                    <td>Upto {{ $tax->amount_1 }} - {{ $tax->rate_1 }}% <br> Above {{ $tax->amount_2 }} - {{ $tax->rate_2 }}%</td>
                    
                    @if ($tax->status == 1)
                    <td><span class="badge badge-success">Active</span></td>
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    @endif
                  
                    
                    <td >
                            <a href="{{ route('tax.edit', $tax->id) }}">
                                <i class="fas fa-edit"></i>&nbsp;Edit
                            </a>  
                            <br>
                                
                                <form action="{{ route('tax.destroy', $tax->id)}}" method="post">
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
            <div class="col-12 d-flex justify-content-center">{{ $taxes->links() }}</div>
            </div>

        </div>
    </div>

@endsection