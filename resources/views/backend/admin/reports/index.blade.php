@extends('backend.admin.master')
@section('title','Expenses')
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

    <div>
        <div class="card-header bg-white">
            <h2>Reports

            </h2>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Income</h5>
                                <span class="h2 font-weight-bold mb-0">&#8377; {{$income}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="ni ni-money-coins"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> --}}
                            {{-- <span class="text-nowrap">Since last month</span> --}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Expense</h5>
                                <span class="h2 font-weight-bold mb-0">&#8377; {{$expenses->total}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="ni ni-chart-pie-35"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Invoices</h5>
                                <span class="h2 font-weight-bold mb-0"> {{count($invoices)}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="ni ni-single-copy-04"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">

                        </p>
                    </div>
                </div>
            </div>
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




        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Invoices</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#expenses" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Expenses</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Payments</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="invoices" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="mt-4">
                    <table class="table table-striped table-bordered table-white" id="invoicesTable">
                        <thead class="thead thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Date</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($invoices as $key => $invoice)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$invoice->invoice_no}}</td>
                                <td>{{$invoice->tax}}</td>

                                <td>{{ date("d/m/Y", strtotime($invoice->date))  }}</td>


                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="mt-4">
                    <table class="table table-striped table-bordered table-white" id="expensesTable">
                        <thead class="thead thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Expense</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Category</th>
                                <th scope="col">Date</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($expenses as $key => $expense)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$expense->name}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{ $expense->category->name  }}</td>
                                <td>{{ date("d/m/Y", strtotime($expense->date))  }}</td>


                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="mt-4">
                    <table class="table table-striped table-bordered table-white" id="paymentsTable">
                        <thead class="thead thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Transaction ID</th>

                                <th scope="col">Amount</th>
                                <th scope="col">Method</th>
                                <th scope="col">Date</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($payments as $key => $payment)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{ $payment->transaction_id}}</td>
                                <td>{{ $payment->amount}}</td>
                                <td>{{ $payment->method}}</td>

                                <td>{{ date("d/m/Y", strtotime( $payment->created_at))  }}</td>


                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>



    </div>

</div>

@endsection


@section('scripts')
<script>
    $(document).ready(function() {
    $('#invoicesTable').DataTable( {
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
                    columns: [ 0, 1, 2, 3]
                }}
        ]
        
    } );

 
} );
    $(document).ready(function() {
    $('#expensesTable').DataTable( {
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
                    columns: [ 0, 1, 2, 3]
                }}
        ]
        
    } );

 
} );

    $(document).ready(function() {
    $('#paymentsTable').DataTable( {
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
                    columns: [ 0, 1, 2, 3]
                }}
        ]
        
    } );

 
} );

</script>
@endsection