<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bpm_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 25);
            $table->string('password', 255);
            $table->string('name', 25);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->integer("created_by")->default(1);
            $table->dateTime('created_dt')->default(date('Y-m-d H:i:s'));
            $table->integer("updated_by")->default(1);
            $table->dateTime('updated_dt')->default(date('Y-m-d H:i:s'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bpm_users');
    }
}
