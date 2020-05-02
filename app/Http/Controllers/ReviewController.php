<?php

namespace App\Http\Controllers;

use App\Review;
use App\Home;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $reviews = Review::orderBy('id', 'desc')->paginate(10);
        $home = Home::first();
        return view('backend.admin.reviews.index',compact('home','reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = Home::first();
        return view('backend.admin.reviews.create',compact('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Review::create(
            request() -> validate([
          'title'=> ['required','max:50'],
          'review'=>['required','max:500'],
          'client'=>['required','max:50'],
          'client_info' => ['required','max:50'],
          'client_img' => ['required','max:255'],
         ])
        );
        Session::flash('message', "Review Created");
        return redirect()->route('reviews.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $home = Home::first();
        return view('backend.admin.reviews.edit', compact('home','review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $this->validate($request,[
            'title'=> ['required','max:50'],
          'review'=>['required','max:500'],
          'client'=>['required','max:50'],
          'client_info' => ['required','max:50'],
          'client_img' => ['required','max:255']
        ]);

        $review->title = $request->title;
        $review->review = $request->review;
        $review->client = $request->client;
        $review->client_info = $request->client_info;
        $review->client_img = $request->client_img;
       
        $review->save();
        
        Session::flash('message', "Updated successfully");
        
        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index');
    }
}
