@extends('backend.admin.master')

@section('title',"Edit Homepage")

@section('main')
<div class="container mt-5">
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
                <input value="{{ $home->hotel_name }}" type="text" name="hotel_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Homepage Main Heading</span>
                  </div>
                  <textarea name="main_heading" class="form-control" aria-label="With textarea">{{ $home->main_heading }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Homepage Sub Heading</span>
                  </div>
                  <textarea class="form-control" name="sub_heading" aria-label="With textarea">{{ $home->sub_heading }}</textarea>
                </div>
            </div>
            
<div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Video Link</span>
      </div>
      <input type="text" value="{{ $home->video_link }}" class="form-control" name="video_link" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
</div>

<div class="row">
  <div class="col-md-4 col-sm-4 mb-5">
    <img src="/storage/cover_images/{{ $home->banner_image }}" class="img-fluid" alt="...">
  </div>        
</div>   

<h3>Edit Banner Image</h3>
<div class="custom-file">
  <input value="{{ $home->banner_image }}" type="file" name="banner_image" class="custom-file-input" id="customFileLang" lang="en" enctype="multipart/form-data">
  <label class="custom-file-label" for="customFileLang">Select file</label>
</div>
            

           <h3 class="mt-5 mb-3">About Section</h3>
                <div class="form-group">
                    <div class="input-group input-group-lg">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-lg">About Section Title</span>
                      </div>
                      <input type="text" value="{{ $home->about_title}}" name="about_title" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">About Section Description 1</span>
                      </div>
                      <textarea name="about_description_1" class="form-control" aria-label="With textarea">{{ $home->about_description_1}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">About Section Description 2</span>
                      </div>
                      <textarea name="about_description_2" class="form-control" aria-label="With textarea">{{ $home->about_description_1}}</textarea>
                    </div>
                </div>

                <h3 class="mt-3">About Image 1</h3>
                <div class="custom-file">
                    <input value="{{ $home->about_image_1}}" type="file" name="about_image_1" class="custom-file-input" id="customFileLang" lang="en" enctype="multipart/form-data">
                    <label class="custom-file-label" for="customFileLang">Select file</label>
                </div>

                <h3 class="mt-3">About Image 2</h3>
                <div class="custom-file">
                    <input value="{{ $home->about_image_2}}" type="file" name="about_image_2" class="custom-file-input" id="customFileLang" lang="en" enctype="multipart/form-data">
                    <label class="custom-file-label" for="customFileLang">Select file</label>
                </div>

                <input name="_method" type="hidden" value="PUT">
                <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection