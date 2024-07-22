<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('pay_id');
            $table->unsignedBigInteger('userid');
            $table->string('order_id', 20);
            $table->unsignedInteger('deladd_id');
            $table->dateTime('payment_date')->default(now());
            $table->enum('payment_method', ['Cash on Delivery', 'Direct Bank Transfer']);
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('userid')->references('userid')->on('userinfos');
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('deladd_id')->references('deladd_id')->on('delivery_addresses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}
