<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegotiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiations', function (Blueprint $table) {
            $table->bigIncrements('negotiation_id');
            $table->unsignedBigInteger('vehicle_id')->references('vehicle_id')->on('vehicles')->onDelete('cascade');
            $table->string('from_destination');
            $table->string('to_destination');
            $table->string('amount');
            $table->integer('status');
            $table->unsignedBigInteger('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('negotiations');
    }
}
