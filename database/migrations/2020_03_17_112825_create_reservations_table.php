<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('room_type_id');
            $table->integer('adults')->default(1);
            $table->integer('kids')->default(0);
            $table->date('check_in');
            $table->date('check_out');
            $table->float('total');
            $table->float('total_tax');
            $table->float('total_plus_tax');
            $table->integer('number_of_room')->default(1);
            $table->enum('status',['PENDING','CANCEL','SUCCESS'])->default('PENDING');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
