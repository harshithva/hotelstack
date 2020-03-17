<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->string('usertype')->default('user');
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->longText('address')->nullable();
            $table->enum('sex',['M','F','O'])->default('M');
            $table->string('picture')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('id_card_image_front')->nullable();
            $table->string('id_card_image_back')->nullable();
            $table->string('company_name')->nullable();
            $table->string('gst_no')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('vip')->default(0);
            $table->boolean('status')->default(1);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
