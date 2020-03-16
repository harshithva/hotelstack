<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Harshith',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'usertype' => 'admin'
        ]);
    }
}