<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_info', function (Blueprint $table) {
            $table->id('purchase_id');
            $table->foreignId('supplier');
            $table->decimal('total_bill', 8, 2);
            $table->decimal('vat', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('paid_or_due', 8, 2);
            $table->decimal('paid_amount', 8, 2);
            $table->decimal('due_amount', 8, 2);
            $table->date('purchased_date');
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
        Schema::dropIfExists('purchase_info');
    }
}
