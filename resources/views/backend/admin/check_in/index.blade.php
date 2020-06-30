@extends('backend.admin.master')
@section('title', 'Reservations')
@section('main')
<div class="main-content p-4" id="panel">
  <div class="table-responsive">
    <div>
      <div class="card-header bg-white">
        <h2>Check in's
          <a class="btn btn-success float-right" href="{{ route('check_in.guest') }}"><i
              class="fa fa-plus"></i>&nbsp;Add Check in</a>
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
        <table class="table table-striped table-bordered table-white" id="checkInsTable">

          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="name">Sl. No.</th>
              <th scope="col" class="sort" data-sort="budget">Booking ID</th>
              <th scope="col" class="sort" data-sort="status">Booking Date</th>
              <th scope="col" class="sort" data-sort="status">Guest</th>
              <th scope="col" class="sort" data-sort="completion">Check in</th>
              <th scope="col" class="sort" data-sort="completion">Check Out</th>
              <th scope="col" class="sort" data-sort="completion">Booking Type</th>
              <th scope="col" class="sort" data-sort="completion">Booking Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          @if (count($reservations) > 0)
          @foreach ($reservations as $key => $reservation)


          <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $reservation->uid }}</td>
            <td>{{ $reservation->created_at}}</td>
            <td>{{ optional($reservation->user)->name }}</td>
            <td>{{ $reservation->check_in}}</td>
            <td>{{ $reservation->check_out}}</td>
            <td><span class="badge">Offline</span></td>


            @if ($reservation->status == 'PENDING')
            <td><span class="badge badge-info">Pending</span></td>
            @elseif($reservation->status == 'CANCEL')
            <td><span class="badge badge-danger">Cancelled</span></td>
            @else
            <td><span class="badge badge-success">Success</span></td>
            @endif


            <td>
              <a href="{{ route('reservations.edit', $reservation->id) }}">
                <i class="fas fa-edit"></i>&nbsp;Edit
              </a>
              <br>

              <form action="{{ route('reservations.destroy', $reservation->id)}}" method="post">
                @csrf
                @method('DELETE')
                <span class="text-danger">
                  <i class="fas fa-trash-alt"></i>&nbsp; <button class="text-danger" type="submit"
                    style="background:none!important;border:none;padding:0!important;">Cancel</button>
                </span>
              </form>

              <a href="{{ route('checkin.show', $reservation->id) }}">
                <i class="fas fa-bookmark"></i>&nbsp;View
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
  $('#checkInsTable').DataTable( {
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
                  columns: [ 0, 1, 2, 3,4,5,6,7]
              }}
      ]
      
  } );


} );

</script>
@endsection