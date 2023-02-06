<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesmen', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->json('title');
            $table->string('prosight_id');
            $table->string('email');
            $table->string('phone');
//            $table->string('gender');
            $table->enum('gender', ['m', 'f']);
//            $table->string('marital_status');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesmen');
    }
};
