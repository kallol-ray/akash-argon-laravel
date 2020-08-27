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
    		'is_stored' => '0',
	        'supplier_id' => '1',
	        'product_info_id' => "1",
	        'purchase_invoice_no' => 'A012451',
	        'product_qty' => '100',
	        'total_bill' => '10000',
	        'vat' => '100',
	        'discount' => '100',
	        'paid_or_due' => '0',
	        'paid_amount' => '5000',
	        'due_amount' => '4800',
	        'purchased_date' => now(),
	        'comments' => "no comments",
	        'entry_by' => "Kallol Ray",
	        'created_at' => now()
		]);
    }
}
