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
        $this->call([
        	UsersTableSeeder::class,
        	SupplierTableSeeder::class,
            ProductInfoSeeder::class,            
            // PurchaseOrderInfoInfoSeeder::class,
            CustomerSeeder::class,
            // InventorySeeder::class,
            BrandSeeder::class,
            
        ]);
    }
}
