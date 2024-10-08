<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelTable extends Migration
{
    public function up()
    {
        Schema::create('hotel', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name', 255);
            $table->foreignId('city_id')->constrained('city')->onDelete('cascade');
            $table->string('hotel_address', 255);
            $table->text('details')->nullable();
            $table->enum('active', ['Active', 'Inactive']);
            $table->date('available_from'); // Not nullable
            $table->date('available_to');   // Not nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel');
    }
}
