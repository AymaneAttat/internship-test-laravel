<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->primary('invoice_id');
            $table->string('branch');
            $table->string('city');
            $table->string('customer_type');
            $table->string('gender');
            $table->string('product_line');
            $table->integer('unit_price');
            $table->integer('quantity');
            $table->integer('tax');
            $table->integer('total');
            $table->date('date');
            $table->time('time');
            $table->string('payment');
            $table->integer('cogs');
            $table->integer('gross_margin_percentage');
            $table->integer('gross_income');
            $table->integer('rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
