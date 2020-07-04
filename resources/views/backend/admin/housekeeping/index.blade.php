@extends('backend.admin.master')
@section('title', 'Guests')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Housekeeping
                    <a class="btn btn-success float-right" href="{{ route('housekeeping.create') }}"><i
                            class="fa fa-plus"></i>&nbsp;Add</a>
                </h2>
            </div>

            @if (Session::has('message'))

            <div class="alert alert-success mt-2">{{ Session::get('message') }}</div>

            @endif

            @if (Session::has('danger'))

            <div class="alert alert-danger mt-2">{{ Session::get('danger') }}</div>

            @endif

            @if (Session::has('housekeeping_deleted'))

            <div class="alert alert-danger mt-2">{{ Session::get('housekeeping_deleted') }}</div>

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

            <div class="mt-4">

                <table class="table table-striped table-bordered table-white" id="guestsTable">


                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">Sl. No.</th>
                            <th scope="col" class="sort">Room No</th>
                            <th scope="col" class="sort">Room Type</th>
                            <th scope="col" class="sort">Cleaned By</th>
                            <th scope="col" class="sort">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    @if (count($housekeepings) > 0)
                    @foreach ($housekeepings as $key => $housekeeping)


                    <tr>
                        <td>{{ ($key + 1) }}</td>
                        <td>{{ $housekeeping->room->number }}</td>
                        <td>{{ $housekeeping->room->type->title}}</td>
                        <td>{{ $housekeeping->cleaned_by}}</td>

                        @if ($housekeeping->status == 1)
                        <td><span class="badge badge-success">Done</span></td>
                        @else
                        <td><span class="badge badge-danger">In Progress</span></td>
                        @endif


                        <td>

                            <a data-toggle="modal" data-target="#UpdateHouseKeepingStatus">
                                <i class="fas fa-check"></i>
                            </a>

                            <form action="{{ route('housekeeping.destroy', $housekeeping->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <span class="text-danger">
                                    <i class="fas fa-trash-alt"></i>&nbsp; <button class="text-danger" type="submit"
                                        style="background:none!important;border:none;padding:0!important;">Delete</button>
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
</div>

@include('backend.admin.includes.update_housekeeping_status')

@endsection


@section('scripts')
<script>
    $(document).ready(function() {
  $('#guestsTable').DataTable( {
    "oLanguage": {
"oPaginate": {
"sFirst": "First", // This is the link to the first page
"sPrevious": "&#8592;", // This is the link to the previous page
"sNext": "&#8594;", // This is the link to the next page
"sLast": "Last" // This is the link to the last page
}
},
    
      dom: 'Bfrtip',
      buttons: [
        { "extend": 'print', "text":'Print',"className": 'btn btn-primary btn-sm' , exportOptions: {
                  columns: [ 0, 1, 2, 3,4,5]
              }}
      ]
      
  } );


} );

</script>
@endsection