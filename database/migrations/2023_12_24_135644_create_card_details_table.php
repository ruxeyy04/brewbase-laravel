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
        Schema::create('card_details', function (Blueprint $table) {
            $table->increments('paycard_id');
            $table->unsignedInteger('pay_id'); // Changed to unsignedBigInteger
            $table->unsignedBigInteger('userid'); // Changed to unsignedBigInteger
            $table->string('cardholder_name', 255);
            $table->text('card_number');
            $table->string('expiration', 10);
            $table->string('cvv', 4);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('userid')->references('userid')->on('userinfos')->onDelete('cascade');
            $table->foreign('pay_id')->references('pay_id')->on('payments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_details');
    }
};
