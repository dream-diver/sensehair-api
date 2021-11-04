<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->datetime('booking_time');
            $table->float('charge');
            $table->float('duration')->default(0);

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('promocode_id')->nullable();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string("stripe_client_secret")->nullable();
            $table->string("stripe_id")->nullable();
            $table->string('payment_status')->default('Unpaid');

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('server_id')->references('id')->on('users');
            $table->foreign('promocode_id')->references('id')->on('promocodes');

            $table->softDeletes();
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
        Schema::dropIfExists('bookings');
    }
}
