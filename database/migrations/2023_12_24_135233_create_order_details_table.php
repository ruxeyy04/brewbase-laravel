<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('orddet_id');
            $table->string('order_id', 20);
            $table->unsignedInteger('prod_no');
            $table->integer('quantity');
            $table->decimal('prod_price', 10, 2);
            $table->unsignedBigInteger('addonsID');
            $table->decimal('addonsPrice', 10, 2);
            $table->decimal('totalAmount', 10, 2);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('prod_no')->references('prod_no')->on('products');
            $table->foreign('addonsID')->references('addonsID')->on('addons');
            $table->foreign('order_id')->references('order_id')->on('orders');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
