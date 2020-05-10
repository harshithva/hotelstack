@extends('backend.admin.master')
@section('title', 'Reservation')
@section('main')
<div class="main-content p-4" id="panel">
    <div>
        <div class="card-header bg-white d-print-none">
            <h2>Reports

            </h2>
            <div>
                <div class="row">
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
                                            <i class="ni ni-chart-pie-35"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> --}}
                                    <span class="text-nowrap">Since last month</span>
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
                                    {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> --}}
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>

                    </div>

                </div>



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

                @if (Session::has('room'))

                <div class="alert alert-default mt-2">{{ Session::get('room') }}</div>

                @endif

                <form method="POST" action="{{route("report.store")}}" class="mt-2">
                    {{ csrf_field() }}

                    @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-row justify-center">
                        <div class="col">
                            <input type="text" name="name" class="form-control p-4" placeholder="Expense">
                        </div>
                        <div class="col">
                            <input type="text" name="amount" class="form-control p-4" placeholder="0.00">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary">Add Expense</button>
                        </div>
                    </div>
                </form>
            </div>


            <table class="table mt-4">
                <thead class="thead bg-success text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Expense</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($expenses) > 1)
                    @foreach ($expenses as $expense)
                    <tr>
                        <th scope="row">{{$expense->id}}</th>
                        <td>{{$expense->name}}</td>
                        <td>{{$expense->amount}}</td>
                        <td>{{$expense->created_at}}</td>
                        <td>
                            <form action="{{route("report.destroy",$expense->id)}}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <p>No expenses found.</p>
                    @endif
                </tbody>
            </table>


            @endsection

            @section('scripts')

            @endsection