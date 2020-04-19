<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'room_type_id' => '1',
            'floor_id' => '1',
            'number' => '105',
        ]);
        Room::create([
            'room_type_id' => '1',
            'floor_id' => '1',
            'number' => '106',
        ]);
        Room::create([
            'room_type_id' => '1',
            'floor_id' => '1',
            'number' => '107',
        ]);
        Room::create([
            'room_type_id' => '2',
            'floor_id' => '2',
            'number' => '201',
        ]);
        Room::create([
            'room_type_id' => '2',
            'floor_id' => '2',
            'number' => '202',
        ]);
        Room::create([
            'room_type_id' => '2',
            'floor_id' => '2',
            'number' => '203',
        ]);
    }
}
