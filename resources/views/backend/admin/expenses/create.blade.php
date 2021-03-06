@extends('backend.admin.master')
@section('title','Record Expenses')
@section('main')
<div class="main-content p-4" id="panel">

    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

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

    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white">
                <h2>Create Expense
                    <a class="btn btn-tsk float-right" href="{{ route('expenses.index') }}"><i class="fa fa-list"></i>
                        Expense
                        List</a>
                </h2>


            </div>


            <div class="card-body">

                <form action="{{ route('expenses.store') }}" method="post">
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

                    <div class="input-group mb-3">

                        <select class="browser-default custom-select" required name="category_id">
                            <option selected>Select Expense Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-default" type="button" id="button-addon2" data-toggle="modal"
                                data-target="#AddExpenseCategory"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="name" class="form-control" id="exampleInputEmail1" required name="name">

                    </div>
                    <div class="form-group" app-field-wrapper="note"><label for="note"
                            class="control-label">Note</label><textarea id="note" name="note" class="form-control"
                            rows="4" name="note"></textarea></div>


                    <div class="input-group mb-3">
                        <label for="note" class="control-label">Expense Date</label>
                        <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input name="date" class="form-control datepicker" placeholder="Select date" type="text"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" app-field-wrapper="amount"><label for="amount" class="control-label"> <small
                                class="req text-danger">* </small>Amount</label><input type="number" id="amount"
                            name="amount" class="form-control" value=""></div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>




{{-- expense category modal --}}

@include('backend.admin.includes.add_expense_category')

@endsection


@section('scripts')

<script>


</script>
@endsection