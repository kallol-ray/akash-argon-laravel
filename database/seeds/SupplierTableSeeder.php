<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('supplier')->insert([
    		'supplier_name' => 'Tp Link Dealer',
	        'phone' => '01727379068',
	        'address' => "216, East Rampura, Dhaka-1219",
	        'comments' => 'No comments',
	        'supplier_entry_date' => now(),
	        'entry_by' => "Kallol Ray",
	        'created_at' => now()
		]);
        
    }
}
