<?php

use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('inventory')->insert(
          [
      			'product_info_id' => '1',
  	        'barcode' => '8941193073216',
  	        'qty' => '1',
  	        'entry_by' => 'admin@argon.com',
  	        'created_at' => now()
          ]
      );
    }
}
