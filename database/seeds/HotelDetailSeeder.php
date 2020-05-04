<?php

use Illuminate\Database\Seeder;
use App\HotelDetail;

class HotelDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HotelDetail::create([
            'name' => 'HotelStack',
            'phone_number' => '9148850331',
            'email' => 'contact@vawebsites.in',
            'address' => 'Raj Towers, Ground, Balmatta Rd, Hampankatta, Mangalore, Karnataka 575001',
            'gst_number' => 'GSTID1212832382389',
        ]);
    }
}
