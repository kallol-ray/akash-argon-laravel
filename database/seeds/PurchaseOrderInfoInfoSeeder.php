<?php

use Illuminate\Database\Seeder;

class PurchaseOrderInfoInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_order_info')->insert([
    		'auto_invoice_no' => 'POI-100001',
    		'is_stored' => '0',
	        'supplier_id' => '1',
	        'purchase_invoice_no' => 'A012451',
	        'buyer_adnl_cost' => '50',
			'supplier_adnl_cost' => '50',
	        'vat_percent' => '5',
	        'vat_amount' => '100',
	        'discount' => '100',
	        'paid_or_due' => '0',
	        'paid_amount' => '5000',
	        'due_amount' => '4800',
	        'sub_total' => '10000',
	        'grand_total' => '10000',
	        'purchased_date' => now(),
	        'entry_by' => "Kallol Ray",
	        'created_at' => now()
		]);
    }
}
