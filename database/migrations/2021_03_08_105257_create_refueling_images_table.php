<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefuelingImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refueling_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refuelling_id');
            $table->foreign('refuelling_id')->references('id')->on('refuelings');
            $table->text('image');
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
        Schema::dropIfExists('refueling_images');
    }
}
