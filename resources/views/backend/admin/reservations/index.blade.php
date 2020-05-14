@extends('backend.admin.master')
@section('title', 'Reservations')
@section('main')
<div class="main-content p-4" id="panel">
  <div class="table-responsive">
    <div>
      <div class="card-header bg-white">
        <h2>Reservations
          <a class="btn btn-success float-right" href="{{ route('reservations.guest') }}"><i
              class="fa fa-plus"></i>&nbsp;Add Reservation</a>
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
        <form class="navbar-search navbar-search-light form-inline mr-sm-3 mt-3" id="navbar-search-main" method="POST"
          action="{{ route('guests.search')}}">
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
            <th scope="col" class="sort" data-sort="budget">Reservation Number</th>
            <th scope="col" class="sort" data-sort="status">Reservation Date</th>
            <th scope="col" class="sort" data-sort="status">Guest</th>
            <th scope="col" class="sort" data-sort="completion">Check in</th>
            <th scope="col" class="sort" data-sort="completion">Check Out</th>
            <th scope="col" class="sort" data-sort="completion">Booking Type</th>
            <th scope="col" class="sort" data-sort="completion">Reservation Status</th>
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
          @elseif($reservation->checked_in == 1)
          <td><span class="badge badge-success">Checked in</span></td>
          @elseif($reservation->active == 0)
          <td><span class="badge badge-default">no show</span></td>
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

            <a href="{{ route('reservations.show', $reservation->id) }}">
              <i class="fas fa-bookmark"></i>&nbsp;View
            </a>
            <br>

          </td>
        </tr>
        @endforeach
        @endif
      </table>
    </div>

    <div class="row">
      <div class="col-12 d-flex justify-content-center">{{ $reservations->links() }}</div>
    </div>

  </div>
</div>

@endsection