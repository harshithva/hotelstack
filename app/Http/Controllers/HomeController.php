<?php

namespace App\Http\Controllers;

use App\Home;
use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => ['index', 'show']]);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home = Home::first();
        return view('frontend.home', compact('home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        $home = Home::first();

        if(auth()->user()->usertype == 'admin')
        {
            return view('backend.admin.homepage.edit', compact('home'));
        }
        else 
        {
            return view('backend.user.dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Home $home)
    {
        $home = Home::findOrFail($request->id);

        $this->validate($request, [
            'hotel_name' => 'required|min:3',
            'main_heading' => 'required|min:8',
            'sub_heading' => 'required|min:8',
            'video_link' => 'min:4',
            'banner_image' => 'nullable',
            'about_title' => 'required',
            'about_description_1' => 'required',
            'about_description_2' => 'required',
            'about_image_1' => 'nullable',
            'about_image_2' => 'nullable'
        ]);


   // Handle File Upload
   if($request->hasFile('banner_image')){
    // Get filename with the extension
    $filenameWithExt = $request->file('banner_image')->getClientOriginalName();
    // Get just filename
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    // Get just ext
    $extension = $request->file('banner_image')->getClientOriginalExtension();
    // Filename to store
    $fileNameToStore= $filename.'_'.time().'.'.$extension;
    // Upload Image
    $path = $request->file('banner_image')->storeAs('public/cover_images', $fileNameToStore);
} 
// else {
//     $fileNameToStore = 'noimage.jpg';
// }

        $home->update([
            'hotel_name' => $request->hotel_name,
            'main_heading' => $request->main_heading,

            'sub_heading' => $request->sub_heading,
            'video_link' => $request->video_link,
            'about_title' => $request->about_title,
            'about_description_1' => $request->about_description_1,
            'about_description_2' => $request->about_description_2
            // 'about_image_1' => $this->storeImage($request->about_image_1),
            // 'about_image_2' => $this->storeImage($request->about_image_2)
            
            ]);

            $home->save();
        // Home::findOrFail($request->id)->first()->fill($request->all())->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }

    private function validateRequest()
    {
        return request()->validate([
            'hotel_name' => 'required|min:3',
            'main_heading' => 'required|min:8',
            'sub_heading' => 'required|min:8',
            'video_link' => 'min:4',
            'banner_image' => 'sometimes|file|image|max:5000',
            'about_title' => 'required',
            'about_description_1' => 'required',
            'about_description_2' => 'required',
            'about_image_1' => 'required|file|image|max:5000',
            'about_image_2' => 'required|file|image|max:5000'
        ]);
    }

    private function storeImage($image)
    {
        if($request->hasFile($image)){
            // Get filename with the extension
            $filenameWithExt = $request->file($image)->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file($image)->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file($image)->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        return $fileNameToStore;
    }
}
