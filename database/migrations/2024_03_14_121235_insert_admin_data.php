<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert dummy data into the users table
        DB::table('users')->insert(

            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
