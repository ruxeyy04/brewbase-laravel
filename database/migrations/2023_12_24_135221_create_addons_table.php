<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->id('addonsID');
            $table->string('addons_name', 20);
            $table->decimal('addons_price', 10, 2);
            $table->text('addons_img')->nullable();
            $table->timestamps();
        });

        // Insert initial data
        DB::table('addons')->insert([
            ['addons_name' => 'None', 'addons_price' => 0.00, 'addons_img' => 'none.png'],
            ['addons_name' => 'Black Pearl', 'addons_price' => 10.00, 'addons_img' => 'pearls.png'],
            ['addons_name' => 'Nata De Coco', 'addons_price' => 15.00, 'addons_img' => 'nata.png'],
            ['addons_name' => 'Coffee Jelly', 'addons_price' => 10.00, 'addons_img' => 'coffee.png'],
            ['addons_name' => 'Pandan Jelly', 'addons_price' => 12.00, 'addons_img' => 'pandan.png'],
            ['addons_name' => 'Pineapple Jelly', 'addons_price' => 8.00, 'addons_img' => 'pineapple.png'],
        ]);

        // Update addonsID
        DB::table('addons')->update(['addonsID' => DB::raw('addonsID - 1')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addons');
    }
};
