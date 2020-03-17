<?php

use Illuminate\Database\Seeder;
use App\PaidService;

class PaidServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaidService::create([
            'title' => 'Extra Bed',
            'price' => '600',
            'short_desc' => 'This is a sample description'
        ]);
    }
}
