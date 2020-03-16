<?php
  
use Illuminate\Database\Seeder;
   
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);
        $this->call(HomePageSeeder::class);
        $this->call(FloorSeeder::class);
        $this->call(RoomTypeSeeder::class);
    }
}