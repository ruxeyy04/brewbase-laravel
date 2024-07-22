<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id', 20)->primary(); // Set primary key as varchar(20)
            $table->dateTime('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('status', 20);
            $table->unsignedBigInteger('userid');
            $table->string('prepared_by', 100)->default('0');
            $table->dateTime('received_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}