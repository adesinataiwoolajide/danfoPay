<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_operators', function (Blueprint $table) {
            $table->bigIncrements('operator_id');
            $table->string('name');
            $table->string('phone');
            $table->string('route');
            $table->unsignedBigInteger('vehicle_id')->references('vehicle_id')->on('vehicles')->onDelete('cascade');;
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_operators');
    }
}
