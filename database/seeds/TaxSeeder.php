<?php

use Illuminate\Database\Seeder;
use App\Tax;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tax::create([
            'name' => 'GST',
            'code' => 'GST-1',
            'amount_1' => '1000',
            'amount_2' => '7000',
            'rate_1' =>'12',
            'rate_2' => '18'
        ]);
    }
}
