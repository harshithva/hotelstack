@extends('backend.admin.master')
@section('title', 'Guests')
@section('main')
<div class="main-content p-4" id="panel">

    <div>
        <div class="card-header bg-white">
            <h2>Select Guest
                <a class="btn btn-success float-right" href="{{ route('guests.create') }}"><i
                        class="fa fa-plus"></i>&nbsp;Add Guest</a>
            </h2>
        </div>

        @if (Session::has('guest'))

        <div class="alert alert-default mt-2">{{ Session::get('guest') }}</div>

        @endif

        @if (Session::has('success'))

        <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>

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

        <div class="progress-wrapper">
            <div class="progress-info">
                <div class="progress-label">
                    <span>Task completed</span>
                </div>
                <div class="progress-percentage">
                    <span>10%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                    aria-valuemax="100" style="width: 10%;"></div>
            </div>
        </div>
        <div class="mt-4">
            <table class="table table-striped table-bordered table-white" id="selectGuestTable">

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


                        <a class="btn btn-outline-default btn-sm"
                            href="{{ route('reservations.room_details', $guest->id) }}"><i class="fa fa-plus"></i>&nbsp;
                            Select Guest</a>
                        <br>

                    </td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>



</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
  $('#selectGuestTable').DataTable( {
    "oLanguage": {
"oPaginate": {
"sFirst": "First", // This is the link to the first page
"sPrevious": "&#8592;", // This is the link to the previous page
"sNext": "&#8594;", // This is the link to the next page
"sLast": "Last" // This is the link to the last page
}
},

    
      
  } );


} );

</script>
@endsection