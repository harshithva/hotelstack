<?php

use Illuminate\Database\Seeder;
use App\User;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Vinyas',
            'email' => 'vinyas@guest.com',
            'password' => '123456',
            'vip' =>  '1',
            'phone' => '7975503096'
         ]);
    }
}
