@extends('backend.admin.master')
@section('title', 'Tax')
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Tax
                    <a class="btn btn-success float-right" href="{{ route('tax.create') }}"><i
                            class="fa fa-plus"></i>&nbsp;Add Tax</a>
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
                    <td>Upto {{ $tax->amount_1 }} - {{ $tax->rate_1 }}% <br> Above {{ $tax->amount_2 }} -
                        {{ $tax->rate_2 }}%</td>

                    @if ($tax->status == 1)
                    <td><span class="badge badge-success">Active</span></td>
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    @endif


                    <td>
                        <a href="{{ route('tax.edit', $tax->id) }}">
                            <i class="fas fa-edit"></i>&nbsp;Edit
                        </a>
                        <br>

                        <form action="{{ route('tax.destroy', $tax->id)}}" method="post">
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

        <div class="row">
            <div class="col-12 d-flex justify-content-center">{{ $taxes->links() }}</div>
        </div>

    </div>
</div>

@endsection