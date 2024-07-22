<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->unsignedBigInteger('userid', 20);
            $table->string('fname', 40);
            $table->string('lname', 40);
            $table->string('midname', 100)->nullable();
            $table->string('suffix', 30)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('tel_no', 100)->nullable();
            $table->string('gender', 15)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('street', 50)->nullable();
            $table->string('barangay', 30)->nullable();
            $table->string('city', 40)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('region', 30)->nullable();
            $table->string('country', 40)->default('Philippines');
            $table->string('postalcode', 30)->nullable();
            $table->text('profile_img')->nullable();
            $table->string('status', 50)->default('Logout');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('userid')->references('userid')->on('userinfos')->onDelete('cascade');
        });

        DB::table('userinfos')->insert([
            [
                'userid'=>2023467486479,
                'email'=>'admin@gmail.com',
                'username'=>'admin',
                'usertype'=>'Admin',
                'password'=>'$2y$12$VgyhG/tG7a2iTHS0lfpbw.zRyMa5YQa8669rj.pQem4urYgVB7lni',
                'created_at'=>'2023-12-26 21:36:37',
                'updated_at'=>'2023-12-26 21:36:37'
            ],
            [
                'userid'=>2023497054608,
                'email'=>'incharge@gmail.com',
                'username'=>'incharge',
                'usertype'=>'In-Charge',
                'password'=>'$2y$12$Liu9ZqZC1yme8U9tA4SDNeYfhLSAlJJu7UHK5WRvEcRFJDgs1TsU6',
                'created_at'=>'2023-12-26 21:36:37',
                'updated_at'=>'2023-12-26 21:36:37'
            ],
        ]);
        DB::table('userprofiles')->insert([
            [
                'userid'=>2023467486479,
                'fname'=>'John',
                'lname'=>'Doe',
                'created_at'=>'2023-12-26 21:36:37',
                'updated_at'=>'2023-12-26 21:36:37'
            ],
            [
                'userid'=>2023497054608,
                'fname'=>'Alex',
                'lname'=>'Reclamador',
                'created_at'=>'2023-12-26 21:36:37',
                'updated_at'=>'2023-12-26 21:36:37'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userprofiles');
    }
}
