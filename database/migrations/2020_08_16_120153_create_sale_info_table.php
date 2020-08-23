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
            $table->foreignId('customer');
            $table->decimal('total_bill', 8, 2);
            $table->decimal('vat', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('paid_or_due', 8, 2);
            $table->decimal('paid_amount', 8, 2);
            $table->decimal('due_amount', 8, 2);
            $table->string('entry_by', 50);
            $table->boolean('is_delivered');
            $table->date('saled_date');            
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
