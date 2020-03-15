<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        'hotel_name','main_heading','sub_heading','video_link','banner_image','about_title',
        'about_description_1','about_description_2','about_image_1','about_image_2'
    ];
}
