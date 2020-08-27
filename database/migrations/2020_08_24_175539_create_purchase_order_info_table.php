<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_info', function (Blueprint $table) {
            $table->id('po_info_id');
            $table->boolean('is_stored')->comment('0=By defaut, 1=else');
            $table->foreignId('supplier_id');
            $table->foreignId('product_info_id');
            $table->string('purchase_invoice_no', 50);
            $table->decimal('product_qty', 8, 0);
            $table->decimal('total_bill', 8, 2);
            $table->decimal('vat', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->tinyInteger('paid_or_due')->comment('0=partial payment, 1=due, 2=paid');
            $table->decimal('paid_amount', 8, 2);
            $table->decimal('due_amount', 8, 2);            
            $table->date('purchased_date');
            $table->string('comments', 200);
            $table->string('entry_by', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_info');
    }
}
