<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('customer')->insert(
        [
    		'customer_name' => 'Ami Kallol',
	        'company_name' => 'Kallol Corporation',
	        'phone' => "01727379068",
	        'address' => "216, Rampura, Dhaka-1219",
	        'entry_by' => 'admin@argon.com',
	        'created_at' => now()
        ]
      );
    }
}

