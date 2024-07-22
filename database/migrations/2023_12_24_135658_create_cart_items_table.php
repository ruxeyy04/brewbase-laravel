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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('cart_id');
            $table->unsignedInteger('prod_no');
            $table->unsignedBigInteger('userid');
            $table->integer('quantity');
            $table->unsignedBigInteger('addonsID')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('prod_no')->references('prod_no')->on('products');
            $table->foreign('addonsID')->references('addonsID')->on('addons');
            $table->foreign('userid')->references('userid')->on('userinfos');

            $table->index('prod_no');
            $table->index('addonsID');
            $table->index('userid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
