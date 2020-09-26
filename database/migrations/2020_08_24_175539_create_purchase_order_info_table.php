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
            $table->string('auto_invoice_no', 20)->unique();
            $table->boolean('is_stored')->comment('0=By defaut, 1=else');
            $table->foreignId('supplier_id');
            $table->string('purchase_invoice_no', 50)->nullable();
            $table->decimal('buyer_adnl_cost', 8, 2)->comment('adnl=additional');
            $table->decimal('supplier_adnl_cost', 8, 2)->comment('adnl=additional');
            $table->decimal('vat_percent', 8, 2);
            $table->decimal('vat_amount', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->tinyInteger('paid_or_due')->comment('0=partial payment, 1=due, 2=paid');
            $table->decimal('paid_amount', 8, 2);
            $table->decimal('due_amount', 8, 2);
            $table->decimal('sub_total', 8, 2);
            $table->decimal('grand_total', 8, 2);
            $table->date('purchased_date');
            $table->string('entry_by', 50);
            $table->string('update_by', 50)->nullable();
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
