@extends('backend.admin.master')
@section('title','Add Rooms')
@section('main')
<div class="main-content p-4" id="panel">
  <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->
        {{-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
          <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
            aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </form> --}}
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
              data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
          <li class="nav-item d-sm-none">
            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
              <i class="ni ni-zoom-split-in"></i>
            </a>
          </li>


        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">

            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>

              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>

                <span>Logout</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="card">
    <div class="card-header bg-white">
      <h2>Create Room
        <a class="btn btn-tsk float-right" href="{{ route('rooms.index') }}"><i class="fa fa-list"></i> Floor List</a>
      </h2>
    </div>


    <div class="card-body">
      <form action="{{ route('rooms.store') }}" method="post" enctype="multipart/form-data"><input type="hidden">
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <div class="form-row justify-content-center">
          <div class="form-group col-md-12">
            <label><strong>Number</strong> <small class="text-danger">*</small></label>
            <input type="text" class="form-control form-control-lg" name="number" placeholder="Room number" required>
          </div>
        </div>

        <div class="form-row justify-content-center">

          <div class="form-group col-md-6">
            <label><strong>Floor</strong> <small class="text-danger">*</small></label>
            <select name="floor_id" class="form-control" id="exampleFormControlSelect1">
              @if ($floors)
              @foreach ($floors as $floor)
              <option value="{{ $floor->id }}">{{ $floor->name }}</option>
              @endforeach
              @endif
            </select>
          </div>

          <div class="form-group col-md-6">
            <label><strong>Room Type</strong> <small class="text-danger">*</small></label>
            <select name="room_type_id" class="form-control" id="exampleFormControlSelect1">
              @if ($room_types)
              @foreach ($room_types as $room_type)
              <option value="{{ $room_type->id }}">{{ $room_type->title }}</option>
              @endforeach
              @endif
            </select>
          </div>
        </div>

        <div class="form-row justify-content-center">

          <div class="form-group col-md-12">
            <label><strong>Room Image</strong> <small class="text-danger">*</small></label>
            <div class="custom-file">
              <input type="file" name="image" class="custom-file-input" id="customFileLang" lang="en"
                enctype="multipart/form-data">
              <label class="custom-file-label" for="customFileLang">Select file</label>
            </div>
          </div>
        </div>

        <div class="form-row justify-content-center">
          <div class="form-group col-sm-12">

            <h3>Status</h3>
            <label class="custom-toggle">
              <input id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger"
                data-toggle="toggle" name="status">
              <span class="custom-toggle-slider rounded-circle" data-label-off="off" data-label-on="on"></span>
            </label>
          </div>
          <div class="form-row justify-content-center">
            <div class="form-group col-sm-12">
              <hr>

            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i>&nbsp;Save</button>
      </form>
    </div>
  </div>

</div>

@endsection