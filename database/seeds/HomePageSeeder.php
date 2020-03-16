<?php

use Illuminate\Database\Seeder;
use App\Home;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Home::create([
            'hotel_name' => 'HotelPlex',
            'main_heading' => 'Feeling cool like your favorite place.',
            'sub_heading' => 'Feeling cool like your favorite place.',
            'video_link' =>  'https://www.youtube.com/embed/lZORMUufA_Y',
            'banner_image' => 'people-art-festival-music-3911237_1584294453.jpg',
            'about_title' => 'Begin your amazing adventure.',
            'about_description_1' => 'The humid subtropical climate, high mountains, exotic vegetation, endless beaches, national parks, historic architecture, exciting attraction sites, art festivals and lively multicultural environment make Sochi a prominent resort destination.',
            'about_description_2' => 'The humid subtropical climate, high mountains, exotic vegetation, endless beaches, national parks, historic architecture, exciting attraction sites, art festivals and lively multicultural environment make Sochi a prominent resort destination.'
        ]);
    }
}
