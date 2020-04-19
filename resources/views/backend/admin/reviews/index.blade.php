@extends('backend.admin.master')
@section('title', 'Reservations')
@section('main')
<div class="main-content p-4" id="panel">
    <div class="table-responsive">
        <div>
            <div class="card-header bg-white">
                <h2>Reviews
                    <a class="btn btn-success float-right" href="{{ route('reviews.create') }}"><i
                            class="fa fa-plus"></i>&nbsp;Add Review</a>
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


            @foreach ($reviews as $review)
            <div class="card m-4" style="width: 18rem;">

                <div class="card-body">
                    <h5 class="card-title">{{$review->title}}</h5>
                    <p class="card-text">{{str_limit($review->review , 100) }}</p>
                    <img src="{{$review->client_img}}" class="img-fluid rounded-circle" style="height:40px;">
                    <div class="d-inline">
                        <span class="text-mr-2">&nbsp;&nbsp;{{$review->client}}</span>
                        <span
                            class="text-m-2 opacity-4 d-block">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$review->client_info}}</span>
                    </div>

                    <div class="mt-3 float-right">


                        <a href="{{route('reviews.edit', $review->id)}}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{route('reviews.destroy', $review->id)}}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach


            @endsection