<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('structure')->nullable();
            $table->text('function')->nullable();
            $table->integer('user_id');
            $table->string('category')->nullable();
            $table->string('description')->nullable();
            $table->text('xml')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('block');
    }
}
