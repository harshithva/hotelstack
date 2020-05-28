@extends('backend.admin.master')

@section('title',"Edit Homepage")

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
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./backend/assets/img/theme/team-4.jpg">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                </div>
              </div>
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
  <div class="row mt-5">
    <div class="col">
      <h1 class="mt-2 mb-3 text-center">Customize your Homepage</h1>

      <form method="POST" action="{{ route('homepageupdate', $home->id)}}" enctype="multipart/form-data">
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

        <div class="form-group">
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-lg">Hotel Name</span>
            </div>
            <input value="{{ $home->hotel_name }}" type="text" name="hotel_name" class="form-control"
              aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Homepage Main Heading</span>
            </div>
            <textarea name="main_heading" class="form-control"
              aria-label="With textarea">{{ $home->main_heading }}</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Homepage Sub Heading</span>
            </div>
            <textarea class="form-control" name="sub_heading"
              aria-label="With textarea">{{ $home->sub_heading }}</textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Video Link</span>
            </div>
            <input type="text" value="{{ $home->video_link }}" class="form-control" name="video_link"
              aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 col-sm-4 mb-5">
            <img src="/storage/cover_images/{{ $home->banner_image }}" class="img-fluid" alt="...">
          </div>
        </div>

        <h3>Edit Banner Image</h3>
        <div class="custom-file">
          <input value="{{ $home->banner_image }}" type="file" name="banner_image" class="custom-file-input"
            id="customFileLang" lang="en" enctype="multipart/form-data">
          <label class="custom-file-label" for="customFileLang">Select file</label>
        </div>


        <h3 class="mt-5 mb-3">About Section</h3>
        <div class="form-group">
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-lg">About Section Title</span>
            </div>
            <input type="text" value="{{ $home->about_title}}" name="about_title" class="form-control"
              aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">About Section Description 1</span>
            </div>
            <textarea name="about_description_1" class="form-control"
              aria-label="With textarea">{{ $home->about_description_1}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">About Section Description 2</span>
            </div>
            <textarea name="about_description_2" class="form-control"
              aria-label="With textarea">{{ $home->about_description_1}}</textarea>
          </div>
        </div>

        <h3 class="mt-3">About Image 1</h3>
        <div class="custom-file">
          <input value="{{ $home->about_image_1}}" type="file" name="about_image_1" class="custom-file-input"
            id="customFileLang" lang="en" enctype="multipart/form-data">
          <label class="custom-file-label" for="customFileLang">Select file</label>
        </div>

        <h3 class="mt-3">About Image 2</h3>
        <div class="custom-file">
          <input value="{{ $home->about_image_2}}" type="file" name="about_image_2" class="custom-file-input"
            id="customFileLang" lang="en" enctype="multipart/form-data">
          <label class="custom-file-label" for="customFileLang">Select file</label>
        </div>

        <input name="_method" type="hidden" value="PUT">
        <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Update</button>
      </form>
    </div>
  </div>
</div>
@endsection