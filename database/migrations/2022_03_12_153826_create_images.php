<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id');
            $table->string('pass_photo')->default(null);
            $table->string('snils_photo')->default(null);
            $table->string('sts_front');
            $table->string('sts_back');
            $table->string('pts_front');
            $table->string('pts_back');
            $table->string('ts_front');
            $table->string('ts_back');
            $table->string('ts_right');
            $table->string('ts_left');
            $table->string('vin_door');
            $table->string('vin_glass');
            $table->string('tire');
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
        Schema::dropIfExists('images');
    }
}
