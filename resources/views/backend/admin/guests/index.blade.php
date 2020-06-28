@extends('backend.admin.master')
@section('title', 'Guests')
@section('main')
<div class="main-content p-4" id="panel">
  <div class="table-responsive">
    <div>
      <div class="card-header bg-white">
        <h2>Guests
          <a class="btn btn-success float-right" href="{{ route('guests.create') }}"><i class="fa fa-plus"></i>&nbsp;Add
            Guest</a>
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

      <div class="mt-4">

        <table class="table table-striped table-bordered table-white" id="guestsTable">


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


            <td>
              <a href="{{ route('guests.edit', $guest->id) }}">
                <i class="fas fa-edit"></i>&nbsp;Edit
              </a>
              <br>

              <form action="{{ route('guests.destroy', $guest->id)}}" method="post">
                @csrf
                @method('DELETE')
                <span class="text-danger">
                  <i class="fas fa-trash-alt"></i>&nbsp; <button class="text-danger" type="submit"
                    style="background:none!important;border:none;padding:0!important;">Delete</button>
                </span>
              </form>

              <a href="{{ route('guests.show', $guest->id) }}">
                <i class="fas fa-bookmark"></i>&nbsp; View
              </a>
              <br>

            </td>
          </tr>
          @endforeach
          @endif
        </table>
      </div>
    </div>


  </div>
</div>

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