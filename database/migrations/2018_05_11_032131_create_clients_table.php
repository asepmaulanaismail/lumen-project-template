<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bpm_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 25)->unique();
            $table->string('password', 255);
            $table->string('name', 25);
            // $column, $autoincrement, $unsigned
            $table->integer("parent_id", false, true);
            $table->boolean('isActive')->default(true);
            $table->integer("created_by")->default(1);
            $table->dateTime('created_dt')->default(date('Y-m-d H:i:s'));
            $table->integer("updated_by")->default(1);
            $table->dateTime('updated_dt')->default(date('Y-m-d H:i:s'));

            $table->foreign("parent_id")
                ->references('id')->on('bpm_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bpm_clients');
    }
}
