@extends('backend.admin.master')
@section('title','Create new reservation')
@section('main')

<div class="main-content p-4" id="panel">
    <div id="app">

        <div class="card">
            <div class="card-header bg-white">
                <h2>Create New Reservation
                    <a class="btn btn-tsk float-right" href="{{ route('checkin.index') }}"><i class="fa fa-list"></i>
                        Reservation List</a>
                </h2>
            </div>


            <div class="card-body">
                <form action="{{ route('guests.store') }}" method="post" enctype="multipart/form-data"><input
                        type="hidden">
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
            </div>
        </div>
    </div>
    @endsection