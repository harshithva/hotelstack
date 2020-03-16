<?php

use Illuminate\Database\Seeder;
use App\Floor;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Floor::create([
            'name' => '1st Floor',
            'number' => '1',
            'description' => 'This is sample description',
            'status' =>  '1'
        ]);
    }
}
