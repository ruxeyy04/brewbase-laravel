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
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->increments('deladd_id');
            $table->unsignedBigInteger('userid'); // Remove auto-increment from userid
            $table->string('fullname', 255)->nullable();
            $table->string('street', 50);
            $table->string('barangay', 30);
            $table->string('city', 40);
            $table->string('province', 50);
            $table->string('region', 100);
            $table->string('country', 40)->default('Philippines');
            $table->string('postalcode', 30);
            $table->string('phone_number', 20)->nullable();
            $table->text('additionalinfo');
            $table->string('status', 50);
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('userid')->references('userid')->on('userinfos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_addresses');
    }
};
