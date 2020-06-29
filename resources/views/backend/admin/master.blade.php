<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>HotelPlex - @yield('title')</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('backend/assets/img/brand/favicon.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
    type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/argon.css?v=1.2.0')}}" type="text/css">


  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('css/app.css')}}" type="text/css">
</head>

<body>

  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white d-print-none"
    id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="{{route('admin.index')}}">
          <img src="{{ asset('backend/assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="HotelPlex Logo')}}">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('admin.index') ? 'active' : '' }}"
                href="{{route('admin.index')}}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>

            {{-- <li class="nav-item">
              <a class="nav-link" href="#homepage_settings" data-toggle="collapse" aria-expanded="false"
                class="collapsed">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Homepage Settings</span>
              </a>


              <ul id="homepage_settings" class="list-unstyled collapse">
                <li class="nav-item ">
                  <a class="nav-link {{ Route::currentRouteNamed('homepageedit') ? 'active' : '' }}"
            href="{{ route('homepageedit', $home->id)}}">
            <i class="ni ni-bold-up text-primary"></i>
            <span class="nav-link-text">Banner Section</span>
            </a>
            </li>

            <li class="nav-item ">
              <a class="nav-link {{ Route::currentRouteNamed('reviews.index') ? 'active' : '' }}"
                href="{{ route('reviews.index')}}">
                <i class="ni ni-bold-up text-primary"></i>
                <span class="nav-link-text">Reviews</span>
              </a>
            </li>

          </ul>
          </li> --}}


          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('checkin.index') ? 'active' : '' }}"
              href="{{ route('checkin.index') }}">
              <i class="ni ni-spaceship"></i>
              <span class="nav-link-text">Check in</span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('reservations.index') ? 'active' : '' }}"
              href="{{ route('reservations.index') }}">
              <i class="ni ni-bullet-list-67 text-default"></i>
              <span class="nav-link-text">Reservation</span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('guests.index') ? 'active' : '' }}"
              href="{{ route('guests.index') }}">
              <i class="ni ni-single-02 text-yellow"></i>
              <span class="nav-link-text">Guests</span>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('guests.index') ? 'active' : '' }}"
              href="{{ route('guests.index') }}">
              <i class="ni ni-bell-55 text-primary"></i>
              <span class="nav-link-text">House Keeping</span>
            </a>
          </li>



          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('floors.index') ? 'active' : '' }}"
              href="{{ route('floors.index') }}">
              <i class="ni ni-building text-info"></i>
              <span class="nav-link-text">Floors</span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('room_types.index') ? 'active' : '' }}"
              href="{{ route('room_types.index') }}">
              <i class="ni ni-app text-success"></i>
              <span class="nav-link-text">Room Types</span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('rooms.index') ? 'active' : '' }}"
              href="{{ route('rooms.index') }}">
              <i class="ni ni-shop text-default"></i>
              <span class="nav-link-text">Rooms</span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('paid_services.index') ? 'active' : '' }}"
              href="{{ route('paid_services.index') }}">
              <i class="ni ni-money-coins text-warning"></i>
              <span class="nav-link-text">Paid Service</span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('tax.index') ? 'active' : '' }}"
              href="{{ route('tax.index') }}">
              <i class="ni ni-credit-card text-danger"></i>
              <span class="nav-link-text">Tax</span>
            </a>
          </li>


          <li class="nav-item ">
            <a class="nav-link {{ Route::currentRouteNamed('expenses.index') ? 'active' : '' }}"
              href="{{ route('expenses.index') }}">
              <i class="ni ni-briefcase-24 text-warning"></i>
              <span class="nav-link-text">Expense</span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="ni ni-chart-pie-35"></i>
              <span class="nav-link-text">Reports</span>
            </a>
          </li>
          </ul>


          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">

            <li class="nav-item">
              <a class="nav-link active active-pro" href="{{route('home')}}" target="_blank">
                <i class="ni ni-send text-dark"></i>
                <span class="nav-link-text">Visit Homepage</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>



  @yield('main')




  <script src="{{ asset('backend/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('backend/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('backend/assets/js/argon.js?v=1.2.0')}}"></script>
  <script src="{{ asset('backend/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
  </script>
  <script src="{{ asset('js/app.js') }}"></script>
  {{-- datatables --}}
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>






  @yield('scripts')

</body>

</html>