<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('wishlist_id');
            $table->unsignedInteger('prod_no');
            $table->unsignedBigInteger('userid');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('prod_no')->references('prod_no')->on('products');
            $table->foreign('userid')->references('userid')->on('userinfos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
}
