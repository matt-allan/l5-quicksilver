<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pickup_name');
            $table->string('pickup_street');
            $table->string('pickup_city');
            $table->string('pickup_state');
            $table->string('pickup_post_code');
            $table->string('dropoff_name');
            $table->string('dropoff_street');
            $table->string('dropoff_city');
            $table->string('dropoff_state');
            $table->string('dropoff_post_code');
            $table->string('signature')->nullable();
            $table->enum('priority', ['STANDARD', 'RUSH', 'DOUBLE_RUSH', 'TRIPLE_RUSH']);
            $table->enum('status', ['RECEIVED', 'PICKED_UP', 'DELIVERED']);
            $table->integer('requester_id')->unsigned();
            $table->foreign('requester_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deliveries');
    }
}
