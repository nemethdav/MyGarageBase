<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefuelingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refuelings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->timestamp('date_time');
            $table->integer('km_operating_hour');
            $table->float('trip1')->nullable();
            $table->float('trip2')->nullable();
            $table->float('refueled_quantity');
            $table->float('fuel_cost');
            $table->integer('refuelling_cost');
            $table->float('average_consumption');
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
        Schema::dropIfExists('refuelings');
    }
}
