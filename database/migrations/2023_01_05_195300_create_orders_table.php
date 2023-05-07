<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('fName');
            $table->string('lName');
            $table->string('email');
            $table->string('phone');
            $table->string('address1');
            $table->string('address2');
            $table->string('pincode');
            $table->string('payment_mode');
            $table->string('payment_id')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->tinyInteger('status')->default('0');
            $table->string('message')->nullable();
            $table->string('trackingNumber');
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
        Schema::dropIfExists('orders');
    }
}
