<?php

use Illuminate\Database\Seeder;
use App\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            'title' => 'Best hotel!',
            'review' => '— The hotel has everything you need. On the ground
            floor there is a lobby bar, on the second floor there is a zone with an indoor pool
            and sauna, on the seventh floor there is a restaurant and spa-salon. The rooms are
            cleaned every day.',
            'client' => 'Jacob Lane',
            'client_info' => 'from USA',
            'client_img' => 'http://127.0.0.1:8000/./frontend/assets/images/person.jpg'
        ]);
    }
}
