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
        DB::table('product_info')->insert(
            [
        		'title' => 'TP Link Router R8',
    	        'description' => 'No Description',
    	        'model' => "216E0",
    	        'brand' => 'TP-Link',
    	        'info_entry_date' => now(),
    	        'image' => "default@1598295452.jpg",
    	        'entry_by' => "admin@argon.com",
                'updated_by' => "",
    	        'created_at' => now()
            ]
        );
        DB::table('product_info')->insert(
            [
                'title' => 'Tenda Router',
                'description' => 'No Description',
                'model' => "454545",
                'brand' => 'Tenda',
                'info_entry_date' => now(),
                'image' => "default@1598295453.jpg",
                'entry_by' => "admin@argon.com",
                'updated_by' => "",
                'created_at' => now()
            ]
        );
    }
}
