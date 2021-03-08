<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('vehicleNickName');
            $table->unsignedBigInteger('vehicle_type');
            $table->foreign('vehicle_type')->references('id')->on('vehicle_types');
            $table->text('vehicle_image');
            $table->text('manufacturer');
            $table->text('type');
            $table->text('license_plate_number')->nullable();
            $table->integer('year_of_manufacture');
            $table->text('chassis_number')->nullable();
            $table->text('motor_number')->nullable();
            $table->integer('cylinder_capacity');
            $table->integer('performance_kw');
            $table->integer('performance_le');
            $table->date('validity_of_technical_Examination');
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
        Schema::dropIfExists('vehicles');
    }
}
