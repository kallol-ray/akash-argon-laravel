<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sale_info', function (Blueprint $table) {
        $table->id('sale_info_id');
        $table->string('auto_sale_invoice', 20)->unique();
        $table->foreignId('customer_id');
        $table->decimal('sub_total_bill', 8, 2);
        $table->decimal('vat_percent', 8, 2);
        $table->decimal('vat_amount', 8, 2);
        $table->decimal('discount', 8, 2);
        $table->tinyInteger('paid_or_due')->comment('0=Partial payment, 1=Full due, 2=Full paid');
        $table->decimal('paid_amount', 8, 2);
        $table->decimal('due_amount', 8, 2);
        $table->boolean('is_delivered');
        $table->date('saled_date');
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
        Schema::dropIfExists('sale_info');
    }
}
