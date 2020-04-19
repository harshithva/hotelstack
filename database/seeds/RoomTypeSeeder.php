<?php

use Illuminate\Database\Seeder;
use App\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
            'title' => 'Superior Room',
            'slug' => 'superior-room',
            'short_code' => 'SR',
            'description' => 'Superior Room',
            'base_capacity' =>'2',
            'higher_capacity' => '2',
            'kids_capacity' => '2',
            'base_price' => '999'
        ]);

        RoomType::create([
            'title' => 'Deluxe Room',
            'slug' => 'deluxe-room',
            'short_code' => 'DR',
            'description' => 'Deluxe Room',
            'base_capacity' =>'2',
            'higher_capacity' => '2',
            'kids_capacity' => '2',
            'base_price' => '1000'
        ]);
    }
}
