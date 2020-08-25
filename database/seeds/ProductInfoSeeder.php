<?php

use Illuminate\Database\Seeder;

class ProductInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_info')->insert([
    		'title' => 'TP Link Router R8',
	        'description' => 'No Description',
	        'model' => "216E0",
	        'brand' => 'TP-Link',
	        'info_entry_date' => now(),
	        'image' => "default@1598295452.jpg",
	        'entry_by' => "Kallol Ray",
	        'created_at' => now()
		]);
    }
}
