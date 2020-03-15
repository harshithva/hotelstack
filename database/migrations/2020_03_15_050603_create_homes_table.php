<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('main_heading');
            $table->string('sub_heading');
            $table->string('video_link')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('about_title');
            $table->string('about_description_1');
            $table->string('about_description_2');
            $table->string('about_image_1')->nullable();
            $table->string('about_image_2')->nullable();
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
        Schema::dropIfExists('homes');
    }
}
