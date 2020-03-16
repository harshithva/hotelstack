<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Home;
use Illuminate\Http\Request;

class FloorController extends Controller
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
    {   $home = Home::first();
        $floors = Floor::all();
        return view('backend.admin.hotel_config.floors.index', compact('home','floors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = Home::first();
        return view('backend.admin.hotel_config.floors.create', compact('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Floor::create(
        //     request() -> validate([
        //   'name'=> ['required','max:255','unique:floors'],
        //   'number'=>['required','max:255'],
        //   'description'=>['min:3'],
        //   'status' => ['required']
        //  ])
        // );

        $this->validate($request,[
            'name'=>'required|max:191|unique:floors',
            'number'=>'required|integer|unique:floors',
        ]);
        $floor = new Floor;
        $floor->name = $request->name;
        $floor->number = $request->number;
        $floor->description = $request->description;
        $floor->status = $request->has('status')?1:0;
        $floor->save();

        return redirect('/admin/hotel/floors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
        $home = Home::first();
        // $floors = Floor::find($floor->id);
        // return view('backend.admin.hotel_config.floors.edit', compact('home','floors'));

        // $floor = Floor::findorFail($floor);
        // return view('backend.admin.hotel_config.floors.edit',compact('home','floor'));

        
        //Check if post exists before deleting
        if (!isset($floor)){
            return redirect('/admin/hotel/floors')->with('error', 'No Post Found');
        }

        return view('backend.admin.hotel_config.floors.edit',compact('home','floor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Floor $floor)
    {

        $floor = Floor::findorFail($floor->id);
        $floor->name = $request->name;
        $floor->number = $request->number;
        $floor->description = $request->description;
        $floor->status = $request->has('status')?1:0;
        $floor->save();

        $message = "Updation successful";
        $home = Home::first();
        $floors = Floor::all();

        return view('backend.admin.hotel_config.floors.index', compact('home','floors','message'));
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
        $floor->delete();

        $message = "Deletion successful";
        $home = Home::first();
        $floors = Floor::all();

        return redirect('/admin/hotel/floors');
    }
}
