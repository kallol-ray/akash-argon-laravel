<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('brand')->insert([
      	'brand_name' => 'Tp-Link',
  			'entry_by' => 'admin@argon.com',
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Tenda',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'D-Link',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Mikrotik',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Xiaomi',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Netgear',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Huawei',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Asus',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Linksys',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Belkin',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'Cisco',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      DB::table('brand')->insert([
      	'brand_name' => 'TRENDnet',
  			'entry_by' => 'admin@argon.com',        
        'update_by' => '',
        'created_at' => now()
      ]);
      
    }
}
