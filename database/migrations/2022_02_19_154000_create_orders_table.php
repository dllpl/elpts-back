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
            $table->tinyInteger('type_owner')->default(1);

            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('patronymic')->nullable();

            $table->string('org_name')->nullable();
            $table->string('kpp')->nullable();
            $table->string('ogrn')->nullable();

            $table->string('phone');
            $table->string('email');

            $table->string('city');
            $table->string('street');
            $table->string('home');
            $table->string('flat');

            $table->string('pass_serial')->nullable();
            $table->string('pass_number')->nullable();

            $table->string('inn')->nullable();
            $table->string('snils')->nullable();

            $table->string('car_mark');
            $table->string('commercial_name');
            $table->string('car_type');
            $table->string('car_id');
            $table->string('car_color');
            $table->string('drive_ts');
            $table->string('engine_model');
            $table->string('engine_number');
            $table->string('odometr');
            $table->string('engine_power');
            $table->string('engine_volume');
            $table->string('fuel');

            $table->integer('price');
            $table->string('pay_method');
            $table->boolean('pay_success')->default(false);
            $table->integer('status')->default(0);

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
